<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\DataSystem;
use App\Models\Tenants;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DataSystem::create([
            'name' => 'Connect system',
            'owner' => 'Erick Nunez',
            'location' => 'Urb. Las Americas',
            'town' => '07',
            'departament' => '02',
            'country' => 1,
            'phone' => '60623882',
            'email' => 'erick@hibridosv.com',
            'document' => '03547605-9',
            'client_id' => Client::orderBy("id", "asc")->first()->id,
            'tenant_id' => Tenants::orderBy("id", "asc")->first()->id,
            'url' => 'test.connect.test',
            'logo' => 'logo.png',
            'theme' => 1,
        ]);

        DataSystem::create([
            'name' => 'Connect system',
            'owner' => 'Juan Perez',
            'location' => 'Urb. Las Americas',
            'town' => '07',
            'departament' => '02',
            'country' => 1,
            'phone' => '60623882',
            'email' => 'erick@hibridosv.com',
            'document' => '03547605-9',
            'client_id' => Client::orderBy("id", "desc")->first()->id,
            'tenant_id' => Tenants::orderBy("id", "desc")->first()->id,
            'url' => 'test2.connect.test',
            'logo' => 'logo.png',
            'theme' => 1,
        ]);

    }
}
