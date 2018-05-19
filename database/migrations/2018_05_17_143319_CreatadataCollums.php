<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatadataCollums extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collums', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stt')->nullable();
            $table->string('name');
            $table->string('label');
            $table->integer('id_sevice');
            $table->integer('id_table');
            $table->string('type');
            $table->tinyInteger('null');
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
        Schema::dropIfExists('collums');
    }
}
