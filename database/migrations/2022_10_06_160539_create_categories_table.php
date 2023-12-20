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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('pronoun');
            $table->string('img')->nullable();
            $table->string('category_type')->default(1)->comment('1: Principal, 2: Subcategoria, 3: Subsubcategoria');
            $table->string('dependable')->nullable()->comment('Id de la categoria a la que depende');
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
        Schema::dropIfExists('categories');
    }
};
