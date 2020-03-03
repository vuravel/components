<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjmmsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        /* IMPOSSIBLE 
        Schema::create('tagmms', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('model');
            $table->string('title');
            $table->string('description')->nullable();
            $table->timestamps();
        });*/


        Schema::create('filemms', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('model');
            $table->string('path');
            $table->string('name')->nullable();
            $table->string('mime_type')->nullable();
            $table->bigInteger('size')->nullable();
            $table->unsignedInteger('order')->nullable();
            $table->timestamps();
        });

        Schema::create('imagemms', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('model');
            $table->string('path');
            $table->string('name')->nullable();
            $table->string('mime_type')->nullable();
            $table->bigInteger('size')->nullable();
            $table->unsignedInteger('order')->nullable();
            $table->timestamps();
        });

        Schema::create('placemms', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('model');
            $table->text('address');
            $table->decimal('lat', 15, 11);
            $table->decimal('lng', 15, 11);
            $table->string('external_id');
            $table->string('street_number')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->timestamps();
        });

        Schema::create('multiformmms', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('model');
            $table->string('title');
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        //Schema::dropIfExists('tagmms');
        Schema::dropIfExists('filemms');
        Schema::dropIfExists('imagemms');
        Schema::dropIfExists('placemms');
        Schema::dropIfExists('multiformmms');
    }
}
