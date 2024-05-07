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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment("nombre del cliente");
            $table->string('domain')->unique();
            $table->string('hostname');
            $table->string('database');
            $table->string('username');
            $table->text('description')->nullable()->comment("Descripcion del sistema");
            $table->integer('type')->comment('1: Permanent, 2: Monthy');
            $table->integer('system')->nullable()->comment('1: Productos Hibrido, 2: Productos Latam, 3: Restaurante Hibrido, 3: Restaurante Latam');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
