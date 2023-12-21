<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = database_path('permisos.sql');
        DB::unprepared(file_get_contents($sql));
        // app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

    }
}