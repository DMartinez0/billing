<?php

namespace Database\Seeders;

use App\Models\Tenants;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tenants::create([
            'name' => 'Connect',
            'domain' => 'test.connect.test',
            'hostname' => '127.0.0.1',
            'database' => 'connect',
            'username' => 'root',
            'description' => 'Primer tenant',
            'type' => 1,
            'system' => 1
        ]);
        Tenants::create([
            'name' => 'Connect 2',
            'domain' => 'test2.connect.test',
            'hostname' => '127.0.0.1',
            'database' => 'connect2',
            'username' => 'root',
            'description' => 'Segundo tenant',
            'type' => 1,
            'system' => 1
        ]);
    }
}