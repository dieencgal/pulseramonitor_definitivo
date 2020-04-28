<?php

namespace App\Http\Controllers;

use App\Paciente;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use View;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['user', 'admin']);


            $pacientes = Paciente::all()->where('id', (Auth::user()->id) - 1);
            $var="";


            if(Auth::user()->hasRole('user')){

            if(File::exists(base_path('/resources/carpetaPacientes/pendingcontacts/'.Auth::user()->name))) {

                $files = scandir(base_path('/resources/carpetaPacientes/pendingcontacts/' . Auth::user()->name . ''), SCANDIR_SORT_DESCENDING);
                $fil=substr($files[0], 0, 8);
                $fil2=substr($files[0], 9, 5);
                $var = "La última vez que importó sus datos fué el $fil a las $fil2, no olvide importar sus datos al menos una vez cada dos semanas";

            }else {
                $var = "Aun no ha importado ningún dato";
            }


    }else{
                $var='';
            }


            return view('home',['pacientes'=>$pacientes,'var'=>$var]);

        }

        public function login2(Request $request)
        {
            request()->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
            $credentials = $request->orounly('email', 'password');
        if (Auth::attempt($credentials)) {
            dd(Auth::user()->id);
        }else{
            dd('fallo');
        }
        }


}
