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
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->string('sistema');
            $table->text('definicion');
            $table->string('referencia');
            $table->integer('cantidad');
            $table->text('comentarios')->nullable();
            $table->text('descripcion_especifica')->nullable();
            $table->string('peso')->nullable();
            $table->string('fotoDescriptiva')->nullable();
            $table->string('marca')->nullable();
            
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
        Schema::dropIfExists('articulos');
    }
};
