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
        Schema::create('linked_systems', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('to_tenant_id');
            $table->foreign('to_tenant_id')
                            ->references('id')
                            ->on('tenants')
                            ->onDelete('cascade');

            $table->unsignedBigInteger('from_tenant_id');
            $table->foreign('from_tenant_id')
                            ->references('id')
                            ->on('tenants')
                            ->onDelete('cascade');
            $table->integer('status')->nullable()->comment('1: Activo, 0: Inactivo'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('linked_systems');
    }
};
