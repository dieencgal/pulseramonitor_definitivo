<?php

namespace App\Http\Controllers;

use App\Paciente;
use App\Paso;
use App\User;
use Carbon\Carbon;

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
                $fil=substr($files[0], 6, 2);
                $fil1=substr($files[0], 4, 2);
                $fil3=substr($files[0], 0, 2);

                $fil2=substr($files[0], 9, 5);
                $var = "La última vez que importó sus datos fué el $fil/$fil1/$fil3 , no olvide importar sus datos al menos una vez cada dos semanas";

            }else {
                $var = "Aun no ha importado ningún dato";
            }
                return view('home',['pacientes'=>$pacientes,'var'=>$var]);


    }else{
                $vor="";
                $usuario= User::all()->where('id','>',1);
                foreach ($usuario as $user){

                    if(File::exists(base_path('/resources/carpetaPacientes/pendingcontacts/'.Auth::user()->name)) == true){
                $files = scandir(base_path('/resources/carpetaPacientes/pendingcontacts/' . $user->name . ''), SCANDIR_SORT_DESCENDING);

                if(Carbon::now()->subDays(14) >= (date('Y-m-d',strtotime(substr($files[0], 0, 8))))){
                    /*$vor="\r\n" .$vor. "\r\n" ."El usuario ".$user->name." lleva desde el ".(date('Y-m-d',strtotime(substr($files[0], 0, 8))))." sin importar datos, su correo es ".$user->email.".". "\r\n";*/
                     $vor=$vor."El usuario ".$user->name." lleva desde el ".(date('Y-m-d',strtotime(substr($files[0], 0, 8))))." sin importar datos, su correo es ".$user->email."\n";

                    }


                }
                $var='';
                $pacient= Paciente::all();
                foreach ($pacient as $paciente){
                    $cont=Paso::all()->where('paciente_id',$paciente->id)->where('fecha','>',Carbon::now()->subDays(14))->count();
                    $num_pasos= Paso::all()->where('paciente_id',$paciente->id)->where('fecha','>',Carbon::now()->subDays(14))->sum('num_pasos');

                    if($num_pasos !=0 && $cont !=0) {
                        if (($num_pasos / $cont) < 5500) {
                            $pacientes = $paciente->get();
                        }
                        if ($pacientes->count() < 1) {
                            $var = ' No tiene ningún paciente con una media de pasos al día menor que 5500';
                        }
                    }

                }}

                return view('home',['pacientes'=>$pacientes,'var'=>$var,'vor'=>$vor]);
            }




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
