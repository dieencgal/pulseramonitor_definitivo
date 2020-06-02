<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Paciente extends  Model
{

    use SoftDeletes;
    protected $fillable = ['nombre', 'apellidos', 'email','edad','peso', 'sexo','altura', 'operacion','fecha_operacion','tipo_paciente','medico_id'];
    public function medico()
    {
        return $this->hasOne('App\Medico', 'id', 'medico_id');

    }
    public function Encuesta_EQD5(){
        return $this->hasOne('App\Encuesta_EQD5');

    }
    public function Oswestry(){
        return $this->hasOne('App\Encuesta_Oswestry');

    }




    public function paso()
    {
        return $this->hasMany('App\Paso');
    }
    public function resp()
    {
        return $this->hasMany('App\RespuestasEncuesta');
    }
    public function frecuencia_cardiaca()
    {
        return $this->hasMany('App\Frecuencia_cardiaca');
    }
    public function Registro_sueno()
    {
        return $this->hasMany('App\Registro_sueno');
    }
    public function video()
    {
        return $this->hasMany('App\Video');
    }
    public function getFullNameAttribute()
    {
        return $this->nombre .' '.$this->apellidos;
    }

}
