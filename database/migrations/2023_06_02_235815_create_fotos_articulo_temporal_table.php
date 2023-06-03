<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotosArticuloTemporalTable extends Migration
{
    public function up()
    {
        Schema::create('fotos_articulo_temporal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('articulo_temporal_id');
            $table->string('foto_path');
            $table->timestamps();

            $table->foreign('articulo_temporal_id')->references('id')->on('articulo_temporal')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fotos_articulo_temporal');
    }
}

