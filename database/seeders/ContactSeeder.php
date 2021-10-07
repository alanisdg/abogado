<?php

namespace Database\Seeders;

use App\Models\Contact;
use Facade\FlareClient\Http\Client;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::factory()->times(3)->create();
    }
}
