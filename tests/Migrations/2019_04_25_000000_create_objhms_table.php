<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjhmsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        /* IMPOSSIBLE 
        Schema::create('taghms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('obj_id')->index();
            $table->foreign('obj_id')->references('id')->on('objs')->onDelete('cascade');
            $table->string('title');
            $table->string('description')->nullable();
            $table->timestamps();
        });*/

        Schema::create('filehms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('obj_id')->index();
            $table->foreign('obj_id')->references('id')->on('objs')->onDelete('cascade');
            $table->string('path');
            $table->string('name')->nullable();
            $table->string('mime_type')->nullable();
            $table->bigInteger('size')->nullable();
            $table->unsignedInteger('order')->nullable();
            $table->timestamps();
        });

        Schema::create('imagehms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('obj_id')->index();
            $table->foreign('obj_id')->references('id')->on('objs')->onDelete('cascade');
            $table->string('path');
            $table->string('name')->nullable();
            $table->string('mime_type')->nullable();
            $table->bigInteger('size')->nullable();
            $table->unsignedInteger('order')->nullable();
            $table->timestamps();
        });

        Schema::create('placehms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('obj_id')->index();
            $table->foreign('obj_id')->references('id')->on('objs')->onDelete('cascade');
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

        Schema::create('multiformhms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('obj_id')->index();
            $table->foreign('obj_id')->references('id')->on('objs')->onDelete('cascade');
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
        //Schema::dropIfExists('taghms');
        Schema::dropIfExists('filehms');
        Schema::dropIfExists('imagehms');
        Schema::dropIfExists('placehms');
        Schema::dropIfExists('multiformhms');
    }
}
