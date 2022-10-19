<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Str;
class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([ 
        'fullname' => 'Idowu Bastard',
        'email' => 'zoo@gospelunites.com',
        'phone' => '32434',
        'gender' => 'Male',
        'nationality' => 'Nigeria',
        'picture' => 'picture.jpg',
        'password' => bcrypt('administrator'),
        // 'created_at' => Carbon::,
        'device_id' => Str::random(14),
        'remember_token' => ''
        ]);
    }
}
