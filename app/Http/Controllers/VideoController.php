<?php

namespace App\Http\Controllers;

use App\Periodo_sueno;
use App\Registro_sueno;
use App\Video;
use App\Paciente;
use Illuminate\Http\Request;
use Auth;

class VideoController extends Controller
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

            $videos = Video::all();


            return view('videos.index', ['videos' => $videos]);

        } else {

                $videos = Video::all()->where('paciente_id',Auth::user()->id -1);


                return view('ejercicios', ['videos' => $videos]);
            }
        }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function create(){

    $pacientes = Paciente::all()->pluck('nombre','id');

    return view('videos/create', ['pacientes' => $pacientes]);

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
            'url' => 'required|max:255',
            'paciente_id' => 'required|exists:pacientes,id'

        ]);
        $videos = new Video($request->all());
        $videos->save();

        // return redirect('especialidades');

        flash('El vídeo se ha asignado correctamente');

        return redirect()->route('videos.index');
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
        $videos = Video::find($id);

        $paciente = Paciente::all()->pluck('nombre','id');

        return view('videos/edit',['video'=> $videos, 'paciente'=>$paciente ]);    }


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

            'url' => 'required|max:255',
            'paciente_id' => 'required|exists:pacientes,id'
        ]);


        $video = video::find($id);
        $video->fill($request->all());

        $video->save();

        flash('El video se ha modificado correctamente');

        return redirect()->route('videos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ((Auth::user()->hasRole('admin'))) {
            $video =Video::find($id);
            $video->delete();
            flash('El video se ha modificado correctamente');

            return redirect()->route('videos.index');}
        else{
            flash('Sólo los médicos pueden borrar datos');
            return redirect()->route('videos.index');
        }
    }
}
