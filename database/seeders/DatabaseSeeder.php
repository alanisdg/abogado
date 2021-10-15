<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\State::factory(5)->create();

        $this->call(RolesPermissionSeeder::class);
        $this->call(ContactSeeder::class);
    }
}
