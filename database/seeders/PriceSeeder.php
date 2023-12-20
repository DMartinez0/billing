<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Price::create([
            'product_id' => 1,
            'qty' => 1,
            'price' => 100,
            'price_type' => 1
        ]);

        Price::create([
            'product_id' => 1,
            'qty' => 12,
            'price' => 90,
            'price_type' => 1
        ]);
    }
}
