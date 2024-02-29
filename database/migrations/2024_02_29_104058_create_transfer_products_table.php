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
        Schema::create('transfer_products', function (Blueprint $table) {
            $table->uuid('id')->primary();            
            $table->uuid('id_product');
            $table->string('cod')->unique();
            $table->string('description');
            $table->float('quantity');
            $table->string('cod_receive');
            $table->integer('status')->comment('1: Activo, 2: Aceptado, 3: Rechazado'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_products');
    }
};
