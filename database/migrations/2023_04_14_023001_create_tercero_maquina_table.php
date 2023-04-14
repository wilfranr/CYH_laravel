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
        Schema::create('tercero_maquina', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tercero_id')->constrained('terceros')->onDelete('cascade');
            $table->foreignId('maquina_id')->constrained('maquinas')->onDelete('cascade');
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
        Schema::dropIfExists('tercero_maquina');
    }
};
