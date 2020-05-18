<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class survey_title extends Model
{
    //
    public function survey_questions(){
        return $this->hasMany('App\survey_question');
    }
}
