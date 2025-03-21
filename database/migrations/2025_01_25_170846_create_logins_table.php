<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logins', function (Blueprint $table) {
            $table->id('login_id')->incerement();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role',['admin','member','publisher']);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('logins');
    }
};
