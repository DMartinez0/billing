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
        Schema::create('clients', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nit');
            $table->string('ncr');
            $table->string('nombre');
            $table->string('cod_actividad');
            $table->string('desc_actividad');
            $table->string('nombre_comercial')->nullable();
            $table->string('tipo_establecimiento');
            $table->string('direccion_departamento');
            $table->string('direccion_municipio');
            $table->string('direccion_complemento')->nullable();
            $table->string('telefono');
            $table->string('correo');

            $table->string('cod_estable_mh')->nullable();
            $table->string('cod_estable')->nullable();
            $table->string('cod_punto_venta_mh')->nullable();
            $table->string('cod_punto_venta')->nullable();


            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                            ->references('id')
                            ->on('users');
            $table->integer('status')->comment('1: activo, 0 Inactivo'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
