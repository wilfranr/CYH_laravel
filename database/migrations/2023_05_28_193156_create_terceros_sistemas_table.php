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
        Schema::create('terceros_sistemas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tercero_id');
            $table->unsignedBigInteger('sistema_id');
            $table->timestamps();

            // Definir las claves foráneas
            $table->foreign('tercero_id')->references('id')->on('terceros')->onDelete('cascade');
            $table->foreign('sistema_id')->references('id')->on('sistemas')->onDelete('cascade');

            // Definir la clave primaria compuesta
            $table->primary(['tercero_id', 'sistema_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terceros_sistemas');
    }
};
