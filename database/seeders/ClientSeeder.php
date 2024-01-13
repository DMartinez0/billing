<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Client::create([
            'nit' => '02072103861029',
            'ncr' => '2800134',
            'nombre' => 'Erick Adonai Nuñez Martinez',
            'cod_actividad' => '63990',
            'desc_actividad' => 'Programación informatica',
            'nombre_comercial' => 'Hibrido El Salvador',
            'tipo_establecimiento' => "02",
            'direccion_departamento' => "02",
            'direccion_municipio' => "07",
            'direccion_complemento' => 'Las Americas 1, Pol I # 4',
            'telefono' => '60623882',
            'correo' => 'aerick.nunez@gmail.com',
            'cod_estable_mh' => null,
            'cod_estable' => null,
            'cod_punto_venta_mh' => null,
            'cod_punto_venta' => null,
            'pwd' => "Hibrido007-+",
            'user_id' => 1,
            'status' => 1,
        ]);
    }
}