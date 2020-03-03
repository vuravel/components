<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjbtmsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tagbtms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('obj_tagbtm', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('obj_id')->unsigned()->index();
            $table->foreign('obj_id')->references('id')->on('objs')->onDelete('cascade');
            $table->integer('tagbtm_id')->unsigned()->index();
            $table->foreign('tagbtm_id')->references('id')->on('tagbtms')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('filebtms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path');
            $table->string('name')->nullable();
            $table->string('mime_type')->nullable();
            $table->bigInteger('size')->nullable();
            $table->unsignedInteger('order')->nullable();
            $table->timestamps();
        });

        Schema::create('filebtm_obj', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('obj_id')->unsigned()->index();
            $table->foreign('obj_id')->references('id')->on('objs')->onDelete('cascade');
            $table->integer('filebtm_id')->unsigned()->index();
            $table->foreign('filebtm_id')->references('id')->on('filebtms')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('imagebtms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path');
            $table->string('name')->nullable();
            $table->string('mime_type')->nullable();
            $table->bigInteger('size')->nullable();
            $table->unsignedInteger('order')->nullable();
            $table->timestamps();
        });

        Schema::create('imagebtm_obj', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('obj_id')->unsigned()->index();
            $table->foreign('obj_id')->references('id')->on('objs')->onDelete('cascade');
            $table->integer('imagebtm_id')->unsigned()->index();
            $table->foreign('imagebtm_id')->references('id')->on('imagebtms')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('placebtms', function (Blueprint $table) {
            $table->increments('id');
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

        Schema::create('obj_placebtm', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('obj_id')->unsigned()->index();
            $table->foreign('obj_id')->references('id')->on('objs')->onDelete('cascade');
            $table->integer('placebtm_id')->unsigned()->index();
            $table->foreign('placebtm_id')->references('id')->on('placebtms')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('multiformbtms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('multiformbtm_obj', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('obj_id')->unsigned()->index();
            $table->foreign('obj_id')->references('id')->on('objs')->onDelete('cascade');
            $table->integer('multiformbtm_id')->unsigned()->index();
            $table->foreign('multiformbtm_id')->references('id')->on('multiformbtms')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('tagbtm_obj');
        Schema::dropIfExists('tagbtms');
        Schema::dropIfExists('filebtm_obj');
        Schema::dropIfExists('filebtms');
        Schema::dropIfExists('imagebtm_obj');
        Schema::dropIfExists('imagebtms');
        Schema::dropIfExists('placebtm_obj');
        Schema::dropIfExists('placebtms');
        Schema::dropIfExists('multiformbtm_obj');
        Schema::dropIfExists('multiformbtms');
    }
}
