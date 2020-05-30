<?php



namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Paciente;
use Illuminate\Support\Facades\Validator;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = '/home';
    public function __construct()
    {
        $this->middleware('guest');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);}
    protected function create(array $data)
    {

       $t=Paciente::all()->where('email',$data['email'])->count();
        if($t==1){ //SIGNIFICA QUE ESTÁ DADO DE ALTA
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            $user->roles()->attach(Role::where('name', 'user')->first());
            return $user;

        }else{ //EL MÉDICO ES EL PRIMERO EN REGISTRARSE
            if((User::all()->count() < 1)) {

                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                ]);

                $user->roles()->attach(Role::where('name', 'admin')->first());
                return $user;
            }else{
               dd('No puede registrare en el sistema');


            }

    }

    }
    }
