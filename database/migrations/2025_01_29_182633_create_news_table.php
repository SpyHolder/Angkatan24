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
            $table->string('publisher');
            $table->string('covarage_area');
            $table->date('date_publish');
            $table->time('time_publish');
            $table->string('content_news');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
