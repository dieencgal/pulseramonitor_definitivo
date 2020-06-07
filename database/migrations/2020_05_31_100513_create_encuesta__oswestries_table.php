<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncuestaOswestriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encuesta__oswestries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('Intensidad_dolor_espalda_lumbar_4sem',[1,2,3,4,5]);
            $table->enum('Intensidad_dolor_pierna_ciatica_4sem',[1,2,3,4,5]);
            $table->enum('Intensidad_dolor',[1,2,3,4,5]);
            $table->enum('Estar_de_pie',[1,2,3,4,5]);
            $table->enum('Cuidados_personales',[1,2,3,4,5]);
            $table->enum('Dormir',[1,2,3,4,5]);
            $table->enum('Levantar_peso',[1,2,3,4,5]);
            $table->enum('Actividad_sexual',[1,2,3,4,5]);
            $table->enum('Andar',[1,2,3,4,5]);
            $table->enum('Vida_social',[1,2,3,4,5]);
            $table->enum('Estar_sentado',[1,2,3,4,5]);
            $table->enum('Viajar',[1,2,3,4,5]);
            $table->unsignedInteger('paciente_id')->nullable();
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('restrict');
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
        Schema::dropIfExists('encuesta__oswestries');
    }
}
