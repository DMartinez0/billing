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

            $table->string('ambiente')->nullable();
            $table->string('id_envio')->nullable()->comment('Numero a discresion para identificar el documento');
            $table->string('numero_control')->nullable()->comment('Numero de factura segun el MH'); // numero de factura
            $table->uuid('codigo_generacion')->nullable()->comment('Uuid unico de cada documento'); // unico uuid
            $table->integer('version')->nullable();
            $table->string('tipo_dte')->nullable();
            
            $table->json('documento_json')->nullable()->comment('Documento Original');
            $table->text('documento_firmado')->nullable()->comment('Documento convertido a JWT o firmado');
            $table->string('sello_recibido')->nullable()->comment('Sello que devuelve de recibido');
            $table->string('fecha_procesamiento')->nullable();
            $table->string('clasificacion_msg')->nullable();
            $table->string('codigo_msg')->nullable();
            $table->string('descripcion_msg')->nullable();
            $table->text('observaciones')->nullable();

            
            $table->uuid('client_id')->nullable();
            $table->foreign('client_id')
                            ->references('id')
                            ->on('clients');

            $table->integer('email')->nullable()->comment('1: Enviado, 0: Firmado'); 
            $table->integer('status')->nullable()->comment('1: Recibido, 2: Firmado, 3: Rechazado, 4: Procesado'); 

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
