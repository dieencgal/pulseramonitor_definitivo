<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncuestaEQD5STable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encuesta__e_q_d5_s', function (Blueprint $table) {

                $table->bigIncrements('id');
                $table->enum('Movilidad',['No tengo problemas para caminar','Tengo algunos problemas para caminar','Tengo que estar en la cama']);
                $table->enum('Cuidado_personal',['No tengo problemas con el cuidado personal','Tengo algunos problemas para lavarme o vestirme solo','Soy incapaz de lavarme o vestirme solo']);
                $table->enum('Actividades_dia',['No tengo problemas para realizar mis actividades
de todos los días','Tengo algunos problemas para realizar mis actividades
de todos los días','Soy incapaz de realizar mis actividades de todos los días']);
                $table->enum('Dolor_malestar',['No tengo dolor ni malestar','Tengo moderado dolor o malestar','Tengo mucho dolor o malestar']);
                $table->enum('Ansiedad_depresion',['No estoy ansioso/a ni deprimido/a','Estoy moderadamente ansioso/a o deprimido/a','Estoy muy ansioso/a o deprimido/a']);
                $table->unsignedInteger('paciente_id')->nullable();
                $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('restrict');


                $table->timestamps();
                $table->softDeletes();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('encuesta__e_q_d5_s');
    }
}
