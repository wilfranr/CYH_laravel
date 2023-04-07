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
        Schema::create('terceros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('tipo_documento');
            $table->string('numero_documento');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('email');
            $table->string('rol');
            $table->string('dv');
            $table->unsignedBigInteger('ciudad_id')->nullable();
            $table->foreign('ciudad_id')->references('id')->on('ciudades')->onDelete('set null');
            $table->unsignedBigInteger('departamento_id')->nullable();
            $table->foreign('departamento_id')->references('id')->on('departamentos')->onDelete('set null');
            $table->unsignedBigInteger('pais_id')->nullable();
            $table->foreign('pais_id')->references('id')->on('paises')->onDelete('set null');
            $table->string('codigo_postal')->nullable();
            $table->string('estado');
            $table->string('forma_pago')->nullable();
            $table->string('email_factura_electronica')->nullable();
            $table->string('rut')->nullable();
            $table->string('certificacion_bancaria')->nullable();
            $table->string('sitio_web')->nullable();
            $table->integer('puntos')->default(0);
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
        //
    }
};
