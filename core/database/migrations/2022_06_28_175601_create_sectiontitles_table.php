<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectiontitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sectiontitles', function (Blueprint $table) {
            $table->id();
            $table->string('language_id')->nullable();

            $table->string('trending_product_title')->nullable();
            $table->string('trending_product_sub_title')->nullable();

            $table->string('product_title')->nullable();
            $table->string('product_sub_title')->nullable();

            $table->string('blog_title')->nullable();
            $table->string('blog_sub_title')->nullable();

            $table->string('newsletter_title')->nullable();
            $table->string('newsletter_sub_title')->nullable();
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
        Schema::dropIfExists('sectiontitles');
    }
}
