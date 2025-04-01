<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id('news_id')->increment();
            $table->string('picture_news');
            $table->string('headline_news');
            $table->integer('status')->default('0');
            $table->unsignedBigInteger('login_id');
            $table->string('covarage_area');
            $table->date('date_publish');
            $table->time('time_publish');
            $table->text('content_news');
            $table->timestamps();

            $table->foreign('login_id')->references('login_id')->on('logins')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
