<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::create('likeables', function (Blueprint $table) {
            $table->unsignedInteger('like_id');
            $table->unsignedInteger('likeable_id');
            $table->string('likeable_type');
            $table->timestamps();

            $table->foreign('like_id')->references('id')->on('likes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('likeables');
        Schema::drop('likes');
    }
}
