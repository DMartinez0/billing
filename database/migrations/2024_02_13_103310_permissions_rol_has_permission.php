<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tableNames = config('permission.table_names');
        Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) {
            $table->uuid('permission_id');
            $table->foreign('permission_id')
                        ->references('uuid')
                        ->on('permission_permissions')
                        ->onDelete('cascade');
            $table->uuid('role_id');
            $table->foreign('role_id')
                    ->references('uuid')
                    ->on('permission_roles')
                    ->onDelete('cascade');
            $table->primary(['permission_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tableNames = config('permission.table_names');
        Schema::dropIfExists($tableNames['role_has_permissions']);
    }
};
