<?php

namespace App\Http\Controllers;

use App\Encuesta_EQD5;
use App\Encuesta_NRSPain;
use App\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Encuesta_NRSPainController extends Controller
{ public function index()
{
    if ((Auth::user()->hasRole('admin'))) {
        $show = Encuesta_NRSPain::all();
        return view('encuesta_nrspain.index', ['show' => $show]);
    } else {
        $cont = Encuesta_NRSPain::all()->where('paciente_id', Auth::user()->id-1)->count();
        $show = Encuesta_NRSPain::all()->where('paciente_id', Auth::user()->id-1);
        if ($cont == 0) {
            return view('encuesta_nrspain.index', ['show' => $show]);


        } else {
            $show = Encuesta_NRSPain::all()->where('paciente_id', Auth::user()->id-1);

            return view('encuesta_nrspain.index2', ['show' => $show]);
        }


    }
}

    public function create()
    {
        $pacientes= Paciente::all()->pluck('nombre','id');


        return view('encuesta_nrspain.create',['pacientes'=>$pacientes]);

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'Nivel_dolor' => 'required|max:255',
            'paciente_id' => 'required|exists:pacientes,id',


        ]);
        $show = new Encuesta_NRSPain($request->all());
        $show->save();

        // return redirect('especialidades');

        flash('Cuestionario realizado con éxito');

        return redirect()->route('encuesta_nrspain.index');
    }

    public function edit($id)
    {
        $show = Encuesta_NRSPain::find($id);
        $paciente = Paciente::all()->pluck('nombre','id');


        return view('encuesta_nrspain.edit',['show'=> $show,'pacientes'=>$paciente]);

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'Nivel_dolor' => 'required|max:255',
            'paciente_id' =>'required',


        ]);

        $show = Encuesta_NRSPain::find($id);
        $show->fill($request->all());

        $show->save();

        flash('Cuestionario modificado correctamente');

        return redirect()->route('encuesta_nrspain.index');
    }

    public function destroy($id)
    {
        if ((Auth::user()->hasRole('admin'))) {

            $show = Encuesta_NRSPain::find($id);
            $show->delete();
            flash('Cuestionario borrado correctamente');

            return redirect()->route('encuesta_nrspain.index');
        } else {
            flash('Sólo los médicos pueden borrar datos');
            return redirect()->route('encuesta_nrspain.index2');
        }
    }
    //


//
    //
}
