<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    User::create([
            'name' => 'Erick Nunez',
            'email' => 'erick@hibridosv.com',
            'email_verified_at' => now(),
            'password' => bcrypt('007125-'),
            'remember_token' => Str::random(10),
            'type' => 1
        ]);
        // ])->assignRole('Gerente');

    User::create([
        'name' => 'administracion',
        'email' => 'admin@hibridosv.com',
        'email_verified_at' => now(),
        'password' => bcrypt('Hibrido*1-'),
        'remember_token' => Str::random(10),
        'type' => 1
    ]);
    // ])->assignRole('Gerente');

        
        // User::factory(9)->create();
    }
}
