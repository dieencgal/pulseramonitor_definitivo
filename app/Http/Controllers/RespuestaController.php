<?php

namespace App\Http\Controllers;

use App\Periodo_sueno;
use App\PreguntasEncuesta;
use App\Registro_sueno;
use App\RespuestasEncuesta;
use App\Video;
use App\Paciente;
use Illuminate\Http\Request;
use Auth;

class RespuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if ((Auth::user()->hasRole('admin'))) {

            $respuestas = RespuestasEncuesta::all();


            return view('respuesta.index', ['respuestas' => $respuestas]);

        } else {

                $respuestas = RespuestasEncuesta::all()->where('paciente_id',Auth::user()->id -1);


                return view('respuesta.index',['respuestas' => $respuestas]);
            }
        }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function create(){

    $pacientes = Paciente::all()->pluck('nombre','id');
    $preguntas=PreguntasEncuesta::all()->pluck('pregunta');

    return view('respuesta/create', ['pacientes' => $pacientes,'preguntas'=>$preguntas]);

    }





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //
    public function store(Request $request)
    {
        $this->validate($request, [
            'respuesta' => 'required|max:255',

            'pregunta_id' => 'required|exists:preguntas_encuesta,id',
            'paciente_id' => 'required|exists:pacientes,id',

        ]);
        $respuestas = new RespuestasEncuesta($request->all());
        $respuestas->save();

        // return redirect('especialidades');

        flash('La respuesta se ha guardado correctamente');

        return redirect()->route('respuesta.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function show(Periodo_sueno $periodo_sueno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $respuestas = RespuestasEncuesta::find($id);

        $paciente = Paciente::all()->pluck('nombre','id');
        $preguntas= PreguntasEncuesta::all()->pluck('pregunta');

        return view('respuesta/edit',['respuesta'=> $respuestas, 'paciente'=>$paciente, 'pregunta'=>$preguntas ]);    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [

            'respuesta' => 'required|max:255',

            'pregunta_id' => 'required|exists:preguntas_encuesta,id',
            'paciente_id' => 'required|exists:pacientes,id',

        ]);
        $respuesta = RespuestasEncuesta::find($id);
        $respuesta->fill($request->all());
        $respuesta->save();


        flash('La respuesta se ha modificado correctamente');

        return redirect()->route('respuesta.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

            $respuesta =RespuestasEncuesta::find($id);
            $respuesta->delete();
            flash('Respuesta borrada correctamente');

            return redirect()->route('respuesta.index');}


}
