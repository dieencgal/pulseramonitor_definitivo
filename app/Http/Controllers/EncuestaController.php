<?php

namespace App\Http\Controllers;

use App\PreguntasEncuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;




class EncuestaController extends Controller
{
    public function index()
    {
        $show=PreguntasEncuesta::all();
        return view('encuesta.index',['show'=>$show]);
    }
    public function create(){



        return view('encuesta.create');

    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'pregunta' => 'required|max:255',


        ]);
        $show = new PreguntasEncuesta($request->all());
        $show->save();

        // return redirect('especialidades');

        flash('Pregunta añadida');

        return redirect()->route('encuesta.index');
    }
    public function edit($id)
    {
        $show = PreguntasEncuesta::find($id);




        return view('encuesta.edit')->with('show', $show);

    }
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'pregunta' => 'required|max:255',


        ]);

        $show = PreguntasEncuesta::find($id);
        $show->fill($request->all());

        $show->save();

        flash('Pregunta modificada correctamente');

        return redirect()->route('encuesta.index');
    }
    public function destroy($id)
    {
        if ((Auth::user()->hasRole('admin'))) {

            $show = PreguntasEncuesta::find($id);
            $show->delete();
            flash('Pregunta borrada correctamente');

            return redirect()->route('encuesta.index');
        }
        else{
            flash('Sólo los médicos pueden borrar datos');
            return redirect()->route('encuesta.index');
        }
    }
    //
}
