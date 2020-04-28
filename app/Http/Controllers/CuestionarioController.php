<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CuestionarioController extends Controller
{
    //
    public function create(){
        return view('cuestionarios.create');
    }
}
