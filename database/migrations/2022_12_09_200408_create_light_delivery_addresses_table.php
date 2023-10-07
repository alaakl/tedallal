<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('light_delivery_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->string('street');
            $table->integer('block');
            $table->integer('building');
            $table->integer('floor');
            $table->integer('site');
            $table->string('type');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
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
        Schema::dropIfExists('light_delivery_addresses');
    }
};
