<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreguntasEncuesta extends Model
{
    //
    protected $fillable=['pregunta'];


    public function respuestas(){
        return $this -> hasMany('App\RespuestasEncuesta');
    }

}
