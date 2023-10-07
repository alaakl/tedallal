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
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('address_id')->constrained('addresses')->cascadeOnDelete();
            $table->float('total_price');
            $table->float('delivery_price')->nullable();
            $table->float('items_price');
            $table->text('notes')->nullable();
            $table->foreignId('payment_method_id')->constrained('payment_methods_lockup', 'id')->cascadeOnDelete();
            $table->foreignId('status_id')->constrained('billing_status_lockup', 'id')->cascadeOnDelete();
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
        Schema::dropIfExists('billings');
    }
};
