<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('member_pictures', function (Blueprint $table) {
            $table->id('member_picture_id')->increment();
            $table->unsignedBigInteger('member_id');
            $table->string('member_picture');
            $table->timestamps();

            $table->foreign('member_id')->references('member_id')->on('members')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('member_pictures');
    }
};
