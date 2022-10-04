<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->string('fecha', 10);
            $table->string('hora', 10);
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('tiempo_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->ondelete('cascade');
            $table->foreign('tiempo_id')->references('id')->on('tiempos')->ondelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citas');
    }
}
