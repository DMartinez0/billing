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
        Schema::create('documents', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('ambiente');
            $table->string('id_envio')->comment('Numero a discresion para identificar el documento');
            $table->string('numero_control')->comment('Numero de factura segun el MH'); // numero de factura
            $table->uuid('codigo_generacion')->comment('Uuid unico de cada documento'); // unico uuid
            $table->integer('version');
            $table->string('tipo_dte');
            
            $table->json('documento_json')->comment('Documento Original');
            $table->text('documento_firmado')->comment('Documento convertido a JWT o firmado');
            $table->json('documento_sellado')->comment('Documento final del cliente'); // documento final
            
            $table->string('sello_recibido')->comment('Sello que devuelve de recibido');
            $table->string('fecha_procesamiento');
            $table->string('clasificacion_msg');
            $table->string('codigo_msg');
            $table->string('descripcion_msg');

            
            $table->uuid('client_id')->nullable();
            $table->foreign('client_id')
                            ->references('id')
                            ->on('clients');

            $table->uuid('id_sistema')->comment('Unico uuid del sistema que emite');
    
            $table->integer('status')->comment('1: Recibido, 2: Firmado, 3: Rechazado, 4: Procesado'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
