<?php

namespace Database\Seeders;

use App\Models\admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        admin::factory()->create(); // model admin 
        User::factory()->create();
    }
}
