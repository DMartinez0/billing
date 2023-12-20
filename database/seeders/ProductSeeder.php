<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'cod' => '123456789',
            'description' => 'Producto de prueba',
            'quantity' => 100,
            'category_id' => 1,
            'quantity_unit_id' => 1,
            'provider_id' => 1,
            'brand_id' => 1,
            'information' => 'Unidad',
            'tags' => 'Unidad',
            'minimum_stock' => 0,
            'saved' => 1,
            'expires' => 0,
            'composed' => 0,
            'prescription' => 0,
            'service' => 0,
            'promotion' => 0,
            'ecommerce' => 0,
        ]);
    }
}
