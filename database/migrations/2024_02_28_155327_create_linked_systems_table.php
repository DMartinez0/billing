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
            $table->unsignedBigInteger('tenan_to_id');
            $table->foreign('tenan_to_id')
                            ->references('id')
                            ->on('tenants');

            $table->unsignedBigInteger('tenan_from_id');
            $table->foreign('tenan_from_id')
                            ->references('id')
                            ->on('tenants');
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
