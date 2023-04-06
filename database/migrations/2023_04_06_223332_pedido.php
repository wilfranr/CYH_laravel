<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('codPedido');
            $table->integer('codUsuario');
            $table->integer('codCliente');
            $table->integer('codMaquina');
            $table->date('fecha_creacion');
            $table->date('fecha_modificacion');
            $table->string('descripcion');
            $table->string('contacto');
            $table->string('estado');
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
        Schema::dropIfExists('pedidos');
    }
};
