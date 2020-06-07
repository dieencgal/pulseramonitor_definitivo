<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encuesta_Oswestry extends Model
{
    //
    protected $fillable=['Intensidad_dolor_espalda_lumbar_4sem','Intensidad_dolor_pierna_ciatica_4sem','Intensidad_dolor','Cuidados_personales','Estar_de_pie','Dormir','Levantar_peso',' Actividad_sexual','Andar','Vida_social','Estar_sentado','Viajar','paciente_id'];


    public function Encuesta_Oswestry(){
        return $this->hasMany('App\Paciente');

    }
}
