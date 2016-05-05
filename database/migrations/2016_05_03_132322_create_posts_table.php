<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            
            $table->increments('id');
            // 0 => post, 1 => video
            $table->tinyInteger('type');
            $table->string('title', 50);
            $table->longText('body')->nullable();
            // Eligible only when type is 1 (video)
            $table->text('video_src')->nullable();
            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger('cover_id')->nullable();

            $table->boolean('sticky');

            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
