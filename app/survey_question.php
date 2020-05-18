<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class survey_question extends Model
{
    //
    public function survey_titles(){
        return $this->hasOne('App\survey_title');
    }

    public function users(){
        return $this->hasOne('App\User');
    }
}
