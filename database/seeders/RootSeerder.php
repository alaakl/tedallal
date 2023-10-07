<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RootSeerder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            'first_name' => 'root',
            'last_name' => 'root',
            'email' => '123456789@Tadallal.com',
            'phone_number' => '123456789',
            'email_verified_at' =>Carbon::now(),
            'role_id' => '1',
            'password' => Hash::make('123456789'),
        ]);
    }
}
