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

        Schema::disableForeignKeyConstraints();
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('image');
            $table->float('minimum_cost');
            $table->boolean('recommended')->nullable();
            $table->boolean('status')->nullable();
            $table->text('description');
            $table->string('city');
            $table->string('street');
            $table->integer('block');
            $table->integer('building');
            $table->integer('floor');
            $table->integer('site_num');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('commercial_record');
            $table->foreignId('owner_id')->constrained('users','id')->cascadeOnDelete();
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
        Schema::dropIfExists('stores');
    }
};
