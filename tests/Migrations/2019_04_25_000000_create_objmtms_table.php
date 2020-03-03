<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjmtmsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tagmtms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('obj_tagmtm', function(Blueprint $table)
        {
            $table->increments('id');
            $table->morphs('model');
            $table->integer('tagmtm_id')->unsigned()->index();
            $table->foreign('tagmtm_id')->references('id')->on('tagmtms')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('filemtms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path');
            $table->string('name')->nullable();
            $table->string('mime_type')->nullable();
            $table->bigInteger('size')->nullable();
            $table->unsignedInteger('order')->nullable();
            $table->timestamps();
        });

        Schema::create('obj_filemtm', function(Blueprint $table)
        {
            $table->increments('id');
            $table->morphs('model');
            $table->integer('filemtm_id')->unsigned()->index();
            $table->foreign('filemtm_id')->references('id')->on('filemtms')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('imagemtms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path');
            $table->string('name')->nullable();
            $table->string('mime_type')->nullable();
            $table->bigInteger('size')->nullable();
            $table->unsignedInteger('order')->nullable();
            $table->timestamps();
        });

        Schema::create('obj_imagemtm', function(Blueprint $table)
        {
            $table->increments('id');
            $table->morphs('model');
            $table->integer('imagemtm_id')->unsigned()->index();
            $table->foreign('imagemtm_id')->references('id')->on('imagemtms')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('placemtms', function (Blueprint $table) {
            $table->increments('id');
            $table->text('address');
            $table->decimal('lat', 15, 11);
            $table->decimal('lng', 15, 11);
            $table->string('external_id');
            $table->string('street_number')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->timestamps();
        });

        Schema::create('obj_placemtm', function(Blueprint $table)
        {
            $table->increments('id');
            $table->morphs('model');
            $table->integer('placemtm_id')->unsigned()->index();
            $table->foreign('placemtm_id')->references('id')->on('placemtms')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('multiformmtms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('obj_multiformmtm', function(Blueprint $table)
        {
            $table->increments('id');
            $table->morphs('model');
            $table->integer('multiformmtm_id')->unsigned()->index();
            $table->foreign('multiformmtm_id')->references('id')->on('multiformmtms')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('obj_tagmtm');
        Schema::dropIfExists('tagmtms');
        Schema::dropIfExists('obj_filemtm');
        Schema::dropIfExists('filemtms');
        Schema::dropIfExists('obj_imagemtm');
        Schema::dropIfExists('imagemtms');
        Schema::dropIfExists('obj_placemtm');
        Schema::dropIfExists('placemtms');
        Schema::dropIfExists('obj_multiformmtm');
        Schema::dropIfExists('multiformmtms');
    }
}
