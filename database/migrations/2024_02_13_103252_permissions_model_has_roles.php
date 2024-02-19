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

        Schema::create($tableNames['model_has_roles'], function (Blueprint $table) {
            $table->uuid('role_id');
            $table->foreign('role_id')
                    ->references('uuid')
                    ->on('permission_roles')
                    ->onDelete('cascade');
            $table->string('model_type', 255);
            $table->uuid('model_uuid')->default('');
            $table->primary(['role_id', 'model_uuid', 'model_type']);
            $table->index(['model_uuid', 'model_type'], 'model_has_roles_model_id_model_type_index');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tableNames = config('permission.table_names');
        Schema::dropIfExists($tableNames['model_has_roles']);
    }
};
