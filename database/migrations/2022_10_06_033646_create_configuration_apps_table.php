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
        Schema::create('configuration_apps', function (Blueprint $table) {
                $table->id();
                $table->string('app_name');
                $table->string('name');
                $table->string('client');
                $table->string('slogan');
                $table->string('phone');
                $table->string('entry');
                $table->string('document');
                $table->string('tax_document');
                $table->string('email');
                $table->string('address');
                $table->integer('country')->comment('1 = El Salvador, 2 = Guatemala, 3 = Honduras, 4 = Nicaragua, 5 = Costa Rica');
                $table->string('logo');
                $table->text('notes');
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
        Schema::dropIfExists('configuration_apps');
    }
};
