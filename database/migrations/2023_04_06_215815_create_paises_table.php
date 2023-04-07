<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaisesTable extends Migration
{
    public function up()
    {
        Schema::create('paises', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('codigo_iso2', 2);
            $table->string('codigo_iso3', 3);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('paises');
    }
}


