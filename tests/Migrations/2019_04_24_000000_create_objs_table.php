<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('tag')->nullable();
            $table->string('tags')->nullable();
            $table->text('file')->nullable();
            $table->text('image')->nullable();
            $table->text('place')->nullable();
            $table->text('multiform')->nullable();
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
        Schema::dropIfExists('objs');
    }
}
