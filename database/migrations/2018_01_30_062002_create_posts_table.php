<?php

use Illuminate\Support\Facades\Schema;
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
            $table->increments('id');
            $table->string('hash_id')->nullable();
            $table->unsignedInteger('user_id')->index()->nullable();
            $table->string('slug')->nullable();
            $table->string('title')->nullable();
            $table->longText('sub_title')->nullable();
            $table->longText('body')->nullable();
            $table->unsignedInteger('category_id')->index()->nullable();
            $table->boolean('published')->default(false);
            $table->boolean('achived')->default(false);
            $table->string('seo_keywords')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('posts');
    }
}
