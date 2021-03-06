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
            $table->foreignId('user_id', 20);
            $table->string("title", 200);
            $table->string("slug", 200)->unique();
            $table->string("video_url", 3000);
            $table->string("video_label", 30);
            $table->bigInteger("page_views")->default(0);
            $table->string("tags", 200)->nullable();
            $table->text("description", 10000)->nullable();
            $table->string("thumbnail", 200)->nullable();
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