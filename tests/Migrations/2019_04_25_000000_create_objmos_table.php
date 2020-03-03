<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjmosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        /* IMPOSSIBLE
        Schema::create('tagmos', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('model');
            $table->string('title');
            $table->string('description')->nullable();
            $table->timestamps();
        });*/

        Schema::create('filemos', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('model');
            $table->string('path');
            $table->string('name')->nullable();
            $table->string('mime_type')->nullable();
            $table->bigInteger('size')->nullable();
            $table->unsignedInteger('order')->nullable();
            $table->timestamps();
        });

        Schema::create('imagemos', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('model');
            $table->string('path');
            $table->string('name')->nullable();
            $table->string('mime_type')->nullable();
            $table->bigInteger('size')->nullable();
            $table->unsignedInteger('order')->nullable();
            $table->timestamps();
        });

        Schema::create('placemos', function (Blueprint $table) {
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

        Schema::create('multiformmos', function (Blueprint $table) {
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
        //Schema::dropIfExists('tagmos');
        Schema::dropIfExists('filemos');
        Schema::dropIfExists('imagemos');
        Schema::dropIfExists('placemos');
        Schema::dropIfExists('multiformmos');
    }
}
