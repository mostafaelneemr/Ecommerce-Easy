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
        DB::table('admins')->delete();

        DB::table('admins')->insert([
            'name' =>  'Admin',
            'email' =>  'sa@a',
            'password' =>  encrypt('123456789'),
            'email_verified_at' =>  now(),
            'remember_token' =>  null,
        ]);
    }
}
