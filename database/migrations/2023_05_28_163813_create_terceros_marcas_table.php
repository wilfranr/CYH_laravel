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
        Schema::create('tercero_marca', function (Blueprint $table) {
            $table->unsignedBigInteger('tercero_id');
            $table->unsignedBigInteger('marca_id');
            $table->timestamps();

            // Definir las claves foráneas
            $table->foreign('tercero_id')->references('id')->on('terceros')->onDelete('cascade');
            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('cascade');

            // Definir la clave primaria compuesta
            $table->primary(['tercero_id', 'marca_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tercero_marca');
    }
};
