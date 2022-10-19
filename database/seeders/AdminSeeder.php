<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name'=>'Administrator',
            // 'email'=>'admin@gospelunites.com',
            'email'=>'admin@gospelunites.com11',
            'password'=>bcrypt('administrator'),
            'roles'=>0
        ]);
    }
}
