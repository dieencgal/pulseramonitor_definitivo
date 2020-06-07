<?php

namespace App\Http\Controllers;

use App\Encuesta_EQD5;
use App\Paciente;
use App\PreguntasEncuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EncuestaEQD5Controller extends Controller
{

    public function index()
    {
        if ((Auth::user()->hasRole('admin'))) {
            $show = Encuesta_EQD5::all();
            return view('encuesta_eqd5.index', ['show' => $show]);
        } else {
            $cont = Encuesta_EQD5::all()->where('paciente_id', Auth::user()->id-1)->count();
            $show = Encuesta_EQD5::all()->where('paciente_id', Auth::user()->id-1);
            if ($cont == 0) {
                return view('encuesta_eqd5.index', ['show' => $show]);


            } else {
                $show = Encuesta_EQD5::all()->where('paciente_id', Auth::user()->id-1);

                return view('encuesta_eqd5.index2', ['show' => $show]);
            }


        }
    }

    public function create()
    {
        $pacientes= Paciente::all()->pluck('nombre','id');


        return view('encuesta_eqd5.create',['pacientes'=>$pacientes]);

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'Movilidad' => 'required|max:255',
            'Cuidado_personal'=> 'required|max:255',
            'Actividades_dia'=> 'required|max:255',
            'Dolor_malestar'=> 'required|max:255',
            'Ansiedad_depresion'=> 'required|max:255',
            'paciente_id' => 'required|exists:pacientes,id',


        ]);
        $show = new Encuesta_EQD5($request->all());
        $show->save();

        // return redirect('especialidades');

        flash('Encuesta realizada con éxito');

        return redirect()->route('encuesta_eqd5.index');
    }

    public function edit($id)
    {
        $show = Encuesta_EQD5::find($id);
        $paciente = Paciente::all()->pluck('nombre','id');


        return view('encuesta_eqd5.edit',['show'=> $show,'pacientes'=>$paciente]);

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'Movilidad' => 'required|max:255',
            'Cuidado_personal'=> 'required|max:255',
            'Actividades_dia'=> 'required|max:255',
            'Dolor_malestar'=> 'required|max:255',
            'Ansiedad_depresion'=> 'required|max:255',
            'paciente_id' =>'required',


        ]);

        $show = Encuesta_EQD5::find($id);
        $show->fill($request->all());

        $show->save();

        flash('Encuesta modificada correctamente');

        return redirect()->route('encuesta_eqd5.index');
    }

    public function destroy($id)
    {
        if ((Auth::user()->hasRole('admin'))) {

            $show = Encuesta_EQD5::find($id);
            $show->delete();
            flash('Encuesta borrada correctamente');

            return redirect()->route('encuesta_eqd5.index');
        } else {
            flash('Sólo los médicos pueden borrar datos');
            return redirect()->route('encuesta_eqd5.index');
        }
    }
    //


//
}
