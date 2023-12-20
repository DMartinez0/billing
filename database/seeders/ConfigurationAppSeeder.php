<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ConfigurationApp;

class ConfigurationAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConfigurationApp::create([
            'app_name' => 'Sistema de Pruebas',
            'name' => 'Hibrido',
            'client' => 'Erick Nunez',
            'slogan' => 'Soluciones Tecnologicas',
            'phone' => '2222-2222',
            'entry' => 'Entrada',
            'document' => '00000000',
            'tax_document' => '00000000',
            'email' => 'example@hibridosv.com',
            'address' => 'San Salvador, El Salvador',
            'country' => 1,
            'logo' => 'logo.png',
            'notes' => 'Notas',
        ]);
    }
}
