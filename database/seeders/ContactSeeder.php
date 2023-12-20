<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Contact::create([
            'name' => 'Erick Nunez',
            'email' => 'algo@hibridosv.com',
            'phone' => '2222-2222',
            'document' => '00000000',
            'contact_type' => 2,
        ]);
    }
}
