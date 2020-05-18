<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestasEncuesta extends Model
{
    //
    protected $fillable=['respuesta','pregunta_id','paciente_id'];

    public function preguntas_encuesta()
    {
        return $this->hasOne('App\PreguntasEncuesta', 'pregunta', 'pregunta_id');
    }
    public function paciente(){
        return $this -> hasOne('App\Paciente', 'id', 'paciente_id');
    }

}
