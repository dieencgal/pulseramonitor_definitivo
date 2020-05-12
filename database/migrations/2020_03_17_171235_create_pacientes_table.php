<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreatePacientesTable extends Migration
{
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellidos');
            $table->date('edad');
            $table->double('peso');
            $table->enum('sexo', ['hombre', 'mujer']);
            $table->integer('altura');
            $table->string('operacion');
            $table->dateTime("fecha_operacion")->nullable();
            $table->enum('tipo_paciente', ['sano', 'enfermo']);
            $table->unsignedInteger('medico_id')->nullable();
            $table->timestamps();
            $table->foreign('medico_id')->references('id')->on('medicos');
            $table->softDeletes();

        });
    }
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}
