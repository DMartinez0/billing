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
            $table->string('send');
            $table->string('receive');
            $table->timestamp('received_at')->nullable()->comment('Hora de recibido'); 
            $table->timestamp('canceled_at')->nullable()->comment('Hora de rechazado'); 
            $table->string('canceled_by');
            $table->text('comment_send')->nullable()->comment('Comentario de envio'); 
            $table->text('comment_receive')->nullable()->comment('Comentario de recibo'); 
            $table->integer('status')->comment('1: Activo, 2: Aceptado, 0: Eliminado, 3: Rechazado, 4: Parcialmente Aceptado'); 
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
