<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEbannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebanners', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->integer('language_id')->nullable();
            $table->integer('pcategory_id')->nullable();
            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->string('price')->nullable();
            $table->string('button_text')->nullable();
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
        Schema::dropIfExists('ebanners');
    }
}
