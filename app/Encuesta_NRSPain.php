<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encuesta_NRSPain extends Model
{
    protected $fillable=['Nivel_dolor','paciente_id'];
    //
    public function Encuesta_NRSPain(){
        return $this->hasMany('App\Paciente');

    }
}
