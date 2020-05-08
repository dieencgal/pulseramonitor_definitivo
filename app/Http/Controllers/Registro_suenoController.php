<?php

namespace App\Http\Controllers;


use App\Frecuencia_cardiaca;
use App\Registro_sueno;
use App\Paciente;
use App\User;
use ConsoleTVs\Charts\Facades\Charts;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Carbon\Carbon;


use Auth;
use function GuzzleHttp\_current_time;


class Registro_suenoController extends Controller
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
            $registro_suenos = Registro_sueno::all();
            $data = collect([]);
            $data2 = collect([]);
            $data1 = collect([]);// Could also be an array
            $users= Paciente::all();

            foreach ($users as $user) {
                // Could also be an array_push if using an array rather than a collection.
                $cuanta = 0;
                $cuanta = Registro_sueno::all()->where('paciente_id', ($user->id))->where('horas_sueno','>',0)->count();
                if ($cuanta !== 0) {
                    $data->push(Registro_sueno::all()->where('paciente_id', ($user->id))->sum('horas_sueno')/$cuanta);

                    $data1->push($user->id);

                }
            }



            $pacientes = Paciente::all();




            $chart = Charts::database($data, 'bar', 'highcharts')
                ->title("Horas de sueño media de los pacientes")
                ->elementLabel("Horas de sueño medio del paciente")
                ->dimensions(1000, 500)
                ->labels($data1)
                ->values($data)
                ->responsive(true)

            ;


            return view('registro_suenos.index', ['registro_suenos' => $registro_suenos,'chart'=>$chart]);
            //abajo del todo estara comentado la otra forma de hacer index admin
        } else {


        $files = scandir(base_path('/resources/carpetaPacientes/pendingcontacts/'. \Illuminate\Support\Facades\Auth::user()->name.''), SCANDIR_SORT_DESCENDING);
        $newest_file= base_path('/resources/carpetaPacientes/pendingcontacts/'.Auth::user()->name.'/'.$files[0]);
        $pacientes = Paciente::all()->where('id',(Auth::user()->id)-1)->pluck('id');

        if (($handle = fopen($newest_file, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 2000, ',')) !== FALSE) {
                $dateExists = Registro_sueno::where('fecha', $data[0])->where('paciente_id', (Auth::user()->id) - 1)->first();

                if (!$dateExists) {
                    $csv_data = new Registro_sueno ();
                    $csv_data->fecha = $data [0];


                    if ($data [17] == '') {

                        $csv_data->horas_sueno = 0;

                        //LO MEJOR CONVERTIRLO ASTRING toDateTimeString();
                    } else {


                        $csv_data->horas_sueno = number_format($data [17] * 2.77778e-7, 2);

                    }
                    $csv_data->paciente_id = $pacientes[0];
                    $csv_data->save();
                }
            }
            fclose($handle);
        }

            $registro_suenos = Registro_sueno::all()->where('paciente_id', (Auth::user()->id) - 1)->where('horas_sueno','>',1);
        //$registro_suenos= $csv_data::all();


            $chart= Charts::multi('line', 'highcharts')
                ->responsive(true)
                ->dimensions(0, 500)
                ->template("material")
                ->labels($registro_suenos->pluck('fecha'))
                ->title('Media de horas de sueño')
                ->yAxisTitle("Horas")
                ->dataset('Registro de horas de sueño', $registro_suenos->pluck('horas_sueno'));



        return view('registro_suenos.index', ['registro_suenos' => $registro_suenos,'chart'=>$chart]);

    }
}

    /*public function getFromEspecialidad(Request $request){
        if ($request->especialidad != null){
            $enfermedades = Enfermedad::where('especialidad_id',$request->especialidad)->select('id')->get();
            $pacientes = Paciente::whereIn('enfermedad_id',$enfermedades)->get();
        }else{
            $pacientes = Paciente::all();
        }

        return view('pacientes/table',compact('pacientes'));
    }*/
    public function filtrarpaciente(Request $request){
        $pacientes = Paciente::all()->where('id',$request);

        return view('pacientes/filtro',['pacientes'=>$pacientes]);
    }
    public function create(){

        if ((Auth::user()->hasRole('admin'))){
            $pacientes = Paciente::all()->pluck('nombre','id');
            return view('registro_suenos/create', ['pacientes' => $pacientes]);
        }

        else{

            $pacientes = Paciente::all()->where('id',(Auth::user()->id)-1)->pluck('id');

            return view('registro_suenos/create', ['pacientes' => $pacientes[0]]);
        }
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

            'fecha' => 'required|date',
            'horas_sueno' => 'required|max:255',
            'paciente_id' => 'required|exists:pacientes,id'
        ]);
        $registro_suenos = new Registro_sueno($request->all());
        $registro_suenos->save();

        // return redirect('especialidades');

        flash('El registro del sueño se ha creado correctamente');

        return redirect()->route('registro_suenos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function show(Registro_sueno $registro_sueno)
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
        $registro_suenos = Registro_sueno::find($id);

        $pacientes = Paciente::all()->pluck('nombre','id');


        return view('registro_suenos/edit',['registro_sueno'=> $registro_suenos, 'paciente'=>$pacientes ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [

            'fecha' => 'required|date',
            'horas_sueno' => 'required|max:255',
            'paciente_id' => 'required|exists:pacientes,id'
        ]);


        $registro_sueno = Registro_sueno::find($id);
        $registro_sueno->fill($request->all());

        $registro_sueno->save();

        flash('El registro del sueño se ha modificado correctamente');

        return redirect()->route('registro_suenos.index');
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
            $registro_sueno = Registro_sueno::find($id);
            $registro_sueno->delete();
            flash('El registro del sueño se ha modificado correctamente');

            return redirect()->route('registro_suenos.index');
        }
        else{
            flash('Sólo los médicos pueden borrar datos');
            return redirect()->route('registro_suenos.index');
        }
    }
}
