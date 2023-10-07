<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LightDeliveryStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('light_delivery_status')->delete();
        $data = [
            ['state' => 'waiting'],
            ['state' => 'accepted'],
            ['state' => 'delivery'],
            ['state' => 'complete'],
            ['state' => 'rejected']
        ];
        DB::table('light_delivery_status')->insert($data);
    }
}
