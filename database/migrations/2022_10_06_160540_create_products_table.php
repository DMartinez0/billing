<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('cod')->unique();
            $table->string('description');
            $table->float('quantity');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
                    ->references('id')
                    ->on('categories');

            $table->unsignedBigInteger('quantity_unit_id');
            $table->foreign('quantity_unit_id')
                    ->references('id')
                    ->on('quantity_units');

            $table->unsignedBigInteger('provider_id');
            $table->foreign('provider_id')
                    ->references('id')
                    ->on('contacts');

            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')
                    ->references('id')
                    ->on('brands');

            $table->text('information')->nullable();
            $table->string('tags')->nullable();
            $table->integer('minimum_stock')->default(0);
            $table->integer('saved')->default(1);
            $table->integer('expires')->default(0)->comment('Determina si el producto tiene fecha de vencimiento');
            $table->integer('composed')->default(0)->comment('Determina si el producto es compuesto o dependiente de otros productos');
            $table->integer('prescription')->default(0)->comment('Determina si el producto requiere receta medica');
            $table->integer('service')->default(0)->comment('Determina si el producto es un servicio');
            $table->integer('promotion')->default(0)->comment('Determina si el producto es una promocion');
            $table->integer('ecommerce')->default(0)->comment('Determina si el producto esta disponible para venta en linea');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
