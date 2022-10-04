<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitaServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cita_servicios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('citaId')->unsigned();
            $table->bigInteger('servicioId')->unsigned();
            $table->foreign('citaId')->references('id')->on('citas')->ondelete('cascade');
            $table->foreign('servicioId')->references('id')->on('servicios')->ondelete('cascade');
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
        Schema::dropIfExists('cita_servicios');
    }
}
