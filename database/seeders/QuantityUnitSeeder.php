<?php

namespace Database\Seeders;

use App\Models\QuantityUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuantityUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuantityUnit::create([
            'name' => 'Unidad',
            'abbreviation' => 'U',
        ]);
    }
}
