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
        Schema::create('paid_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('image');
            $table->double('price');
            $table->text('description');
            $table->string('store');
            $table->string('category');
            $table->string('type');
            $table->foreignId('billing_id')->constrained('billings', 'id')->cascadeOnDelete();
            $table->integer('quantity')->default(1);
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
        Schema::dropIfExists('paid_products');
    }
};
