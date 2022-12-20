<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_category_id');
            $table->string('title')->nullable()->unique();
            $table->string('slug')->nullable()->unique();
            $table->string('description')->nullable();
            $table->string('link_path')->nullable();
            $table->string('image_path')->nullable();
            $table->string('post');
            $table->unsignedTinyInteger('type')->default(0); // 0 -> normal, 1 -> quote, 2 -> video
            $table->timestamps();

            $table->foreign('blog_category_id')->references('id')->on('blog_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
};
