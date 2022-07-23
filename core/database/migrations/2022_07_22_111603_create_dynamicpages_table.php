<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDynamicpagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dynamicpages', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->integer('language_id')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->binary('body')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('dynamicpages');
    }
}
