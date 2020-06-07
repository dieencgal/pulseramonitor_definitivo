<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encuesta_EQD5 extends Model
{
    protected $fillable=['Movilidad','Cuidado_personal','Actividades_dia', 'Dolor_malestar','Ansiedad_depresion','paciente_id'];
    //
    public function Encuesta_EQD5(){
        return $this->hasMany('App\Paciente');

    }
}
