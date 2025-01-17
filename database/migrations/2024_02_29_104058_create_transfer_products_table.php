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
            $table->uuid('transfer_id')->nullable();
            $table->foreign('transfer_id')
                    ->references('id')
                    ->on('transfers')
                    ->onDelete('cascade');         
            $table->json('product_json');
            $table->string('cod');
            $table->string('description');
            $table->float('quantity');

            $table->float('requested');
            $table->integer('requested_exists')->comment('1: Existe en el host que enviara, 0: No existe'); 

            $table->string('cod_receive');
            $table->integer('create')->default(0)->comment('1: crear registro, 0: sin crear registro'); 
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
