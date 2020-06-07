<?php

namespace App\Http\Controllers;

use App\Encuesta_EQD5;
use App\Encuesta_NRSPain;
use App\Encuesta_Oswestry;
use App\Paciente;
use App\PreguntasEncuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Encuesta_OswestryController extends Controller
{


    public function index()
    {
        if ((Auth::user()->hasRole('admin'))) {
            $show = Encuesta_Oswestry::all();
            return view('encuesta_oswestry.index', ['show' => $show]);
        } else {
            $cont = Encuesta_Oswestry::all()->where('paciente_id', Auth::user()->id - 1)->count();
            $show = Encuesta_Oswestry::all()->where('paciente_id', Auth::user()->id - 1);
            if ($cont == 0) {
                return view('encuesta_oswestry.index', ['show' => $show]);


            } else {
                $show = Encuesta_Oswestry::all()->where('paciente_id', Auth::user()->id - 1);

                return view('encuesta_oswestry.index2', ['show' => $show]);
            }


        }
    }

    public function create()
    {
        $pacientes = Paciente::all()->pluck('nombre', 'id');


        return view('encuesta_oswestry.create', ['pacientes' => $pacientes]);

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'Intensidad_dolor_espalda_lumbar_4sem' => 'required|max:255',
            'Intensidad_dolor_pierna_ciatica_4sem' => 'required|max:255',
            'Intensidad_dolor' => 'required|max:255',
            'Cuidados_personales' => 'required|max:255',
            'Estar_de_pie' => 'required|max:255',
            'Dormir' => 'required|max:255',
            'Levantar_peso' => 'required|max:255',
            'Actividad_sexual' => 'required|max:255',
            'Andar' => 'required|max:255',
            'Vida_social' => 'required|max:255',
            'Estar_sentado' => 'required|max:255',
            'Viajar' => 'required|max:255',
            'paciente_id' => 'required|exists:pacientes,id',



        ]);
        $show = new Encuesta_Oswestry($request->all());
        $show->save();

        // return redirect('especialidades');

        flash('Cuestionario realizado con éxito');

        return redirect()->route('encuesta_oswestry.index');
    }

    public function edit($id)
    {
        $show = Encuesta_Oswestry::find($id);
        $paciente = Paciente::all()->pluck('nombre', 'id');


        return view('encuesta_oswestry.edit', ['show' => $show, 'pacientes' => $paciente]);

    }
    public function cuestionarios(){
        $show=Encuesta_Oswestry::all();
        $show2=Encuesta_EQD5::all();
        $show3=Encuesta_NRSPain::all();
        return view('todas_encuestas',['show'=>$show,'show2'=>$show2,'show3'=>$show3]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'Intensidad_dolor_espalda_lumbar_4sem' => 'required|max:255',
            'Intensidad_dolor_pierna_ciatica_4sem' => 'required|max:255',
            'Intensidad_dolor' => 'required|max:255',
            'Cuidados_personales' => 'required|max:255',
            'Estar_de_pie' => 'required|max:255',
            'Dormir' => 'required|max:255',
            'Levantar_peso' => 'required|max:255',
            'Actividad_sexual' => 'required|max:255',
            'Andar' => 'required|max:255',
            'Vida_social' => 'required|max:255',
            'Estar_sentado' => 'required|max:255',
            'Viajar' => 'required|max:255',
            'paciente_id' => 'required|exists:pacientes,id',


        ]);

        $show = Encuesta_Oswestry::find($id);
        $show->fill($request->all());

        $show->save();

        flash('Cuetionario modificado correctamente');

        return redirect()->route('encuesta_oswestry.index');
    }

    public function destroy($id)
    {
        if ((Auth::user()->hasRole('admin'))) {

            $show = Encuesta_Oswestry::find($id);
            $show->delete();
            flash('Cuestionario borrado correctamente');

            return redirect()->route('encuesta_oswestry.index');
        } else {
            flash('Sólo los médicos pueden borrar datos');
            return redirect()->route('encuesta_oswestry.index');
        }
    }
}
