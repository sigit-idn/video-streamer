<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string("title");
            $table->string("slug")->unique();
            $table->string("video_url");
            $table->string("video_url_2")->nullable();
            $table->string("video_url_3")->nullable();
            $table->string("video_url_4")->nullable();
            $table->string("video_url_5")->nullable();
            // $table->string("category");
            $table->string("tags")->nullable();
            $table->text("description")->nullable();
            $table->string("thumbnail")->nullable();
            $table->integer("likes")->default(0);
            $table->integer("views")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
