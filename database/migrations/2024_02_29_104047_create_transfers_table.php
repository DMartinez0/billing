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
        Schema::create('transfers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('from_tenant_id')->nullable();
            $table->foreign('from_tenant_id')
                ->references('id')
                ->on('tenants');
            $table->unsignedBigInteger('to_tenant_id')->nullable();
            $table->foreign('to_tenant_id')
                ->references('id')
                ->on('tenants');
            $table->string('send')->comment('Usuaario que envia');
            $table->string('receive')->comment('Usuaario que recibe');
            $table->timestamp('received_at')->nullable()->comment('Hora de recibido'); 
            $table->timestamp('canceled_at')->nullable()->comment('Hora de rechazado'); 
            $table->string('canceled_by')->nullable()->comment('Usuario que cancela el pedido'); 
            
            $table->timestamp('request_at')->nullable()->comment('Hora de solicitud del producto'); 
            $table->string('request_by')->comment('Usuario que solicita el producto');
            
            $table->text('comment_send')->nullable()->comment('Comentario de envio'); 
            $table->text('comment_receive')->nullable()->comment('Comentario de recibo'); 
            $table->integer('is_online')->comment('0: Sin productos online, 1: Con productos Online || si aun hay productos aceptados o rechazados debe estar online'); 
            $table->integer('status')->comment('0: Eliminado, 1: En Progreso, 2: Activo, 3: Parcialmente Aceptado, 4: Aceptado, 5: Rechazado'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
