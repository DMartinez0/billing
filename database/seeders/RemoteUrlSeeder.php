<?php

namespace Database\Seeders;

use App\Models\RemoteUrl;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RemoteUrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        RemoteUrl::create([
            'email' => 'erick@hibridosv.com',
            'url' => 'http://test2.connect.test',
            'client_id' => '9b3eedb2-1d52-4ca9-8fe8-8e76bb1aa475',
            'client_secret' => '5IBuSnMTESFUvL8PU00rUt66lBJnsnN187uz8o1a',
        ]);

        RemoteUrl::create([
            'email' => 'admin@hibridosv.com',
            'url' => 'http://test.connect.test',
            'client_id' => '9b3eedb2-1d52-4ca9-8fe8-8e76bb1aa475',
            'client_secret' => '5IBuSnMTESFUvL8PU00rUt66lBJnsnN187uz8o1a',
        ]);

    }
}
