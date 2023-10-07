<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PaymentMethodSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(BillingStatusSeeder::class);
        $this->call(LightDeliveryStatus::class);
        $this->call(RootSeerder::class);

    }
}
