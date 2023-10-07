<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BillingStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('billing_status_lockup')->delete();
        $data = [
            ['name' => 'waiting'],
            ['name' => 'accepted'],
            ['name' => 'delivery'],
            ['name' => 'complete'],
            ['name' => 'rejected']
        ];
        DB::table('billing_status_lockup')->insert($data);
    }
}
