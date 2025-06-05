<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id('member_id')->incerement();
            $table->unsignedBigInteger('login_id');
            $table->string('full_name');
            $table->string('nim')->unique();
            $table->text('description');
            $table->text('quote');
            $table->year('year_in');
            $table->year('year_out')->nullable();
            $table->enum('rarity',['SSR','SR','R','N'])->nullable();
            $table->string('rank')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedid')->nullable();
            $table->string('github')->nullable();
            $table->string('website')->nullable();
            $table->integer('status')->default('0');
            $table->timestamps();

            $table->foreign('login_id')->references('login_id')->on('logins')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
