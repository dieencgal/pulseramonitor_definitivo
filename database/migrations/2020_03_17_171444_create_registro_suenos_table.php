<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroSuenosTable extends Migration
{

public function up()
{
Schema::create('registro_suenos', function (Blueprint $table) {
$table->increments('id');
$table->date('fecha')->nullable();
$table->double('horas_sueno')->nullable;
$table->unsignedInteger('paciente_id')->nullable();
$table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('restrict');
$table->timestamps();
$table->softDeletes();
});
}

public function down()
{
Schema::dropIfExists('registro_suenos');
}
}
