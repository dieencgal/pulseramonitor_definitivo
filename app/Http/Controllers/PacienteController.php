<?php

namespace App\Http\Controllers;

use App\basedatos;
use App\Frecuencia_cardiaca;
use App\Paciente;
use App\Paso;
use App\Registro_sueno;
use App\User;
use Carbon\Carbon;
use ConsoleTVs\Charts\Builder\Chart;
use ConsoleTVs\Charts\Facades\Charts;
use File;
use Illuminate\Http\Request;
use App\Medico;
use Auth;





use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;



class PacienteController extends Controller
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
       /* $pacientes = Paciente::all();
        if(($pacientes->contains('id',1))==true){

           $pacientes->


        }*/
       /* $pacientes = Paciente::all();

        if(($pacientes->contains('id',1))==true) {
            $color = Paciente::where('id', 1);
            $color->delete();
            return view('pacientes.index', ['pacientes' => $pacientes]);
        }*/

        if ((Auth::user()->hasRole('admin'))){


            $data = collect([]);
            $data1 = collect([]);// Could also be an array
            $users= Paciente::all();

            foreach ($users as $user) {
                // Could also be an array_push if using an array rather than a collection.
                $data->push(Paso::all()->where('paciente_id',($user->id))->sum('num_pasos'));
                $data1->push($user->id);
            }

            $pacientes = Paciente::all();



            $products = Paso::all();
            $chart = Charts::database($data, 'bar', 'highcharts')
                ->title("Pasos x paciente")
                ->elementLabel("Pasos del paciente")
                ->dimensions(1000, 500)
                ->labels($data1)
                ->values($data)
                ->responsive(true)

            ;



            return view('pacientes.index', ['pacientes' => $pacientes]);
        }
        else {
            $pacientas = (Paciente::all()->where('id', ((Auth::user()->id))-1))->isEmpty();
            $pacientes = (Paciente::all()->where('id', ((Auth::user()->id))-1));



            if ($pacientas == true) {



                return view('pacientes.index', ['pacientes' => $pacientes]);
            }else {
                if(!File::exists('/resources/carpetaPacientes/pendingcontacts/'.Auth::user()->name)) {
                    File::makeDirectory(base_path('/resources/carpetaPacientes/pendingcontacts/'.Auth::user()->name), $mode = 0777, true, true);

                }
                $pacientes = (Paciente::all()->where('id', ((Auth::user()->id))-1));
                $files = scandir(base_path('/resources/carpetaPacientes/pendingcontacts/'. \Illuminate\Support\Facades\Auth::user()->name.''), SCANDIR_SORT_DESCENDING);
                $newest_file= base_path('/resources/carpetaPacientes/pendingcontacts/'.Auth::user()->name.'/'.$files[0]);

                if (($handle = fopen($newest_file, 'r')) !== FALSE) {
                    while (($data = fgetcsv($handle, 2000, ',')) !== FALSE) {
                        $dateExists = basedatos::where('fecha', $data[0])->where('paciente_id', (\Illuminate\Support\Facades\Auth::user()->id) - 1)->first();
                        if (!$dateExists) {
                            $csv_data = new basedatos ();
                            $csv_data->fecha = $data [0];
                            $csv_data->distancia = $data [2];
                            if ($data [3] == '') {
                                $csv_data->frec_cardiaca_media = 0;
                            } else {
                                $csv_data->frec_cardiaca_media = $data [3];
                            }
                            if ($data [4] == '') {
                                $csv_data->frec_cardiaca_max = 0;
                            } else {
                                $csv_data->frec_cardiaca_max = $data [4];
                            }
                            if ($data [5] == '') {

                                $csv_data->frec_cardiaca_min = 0;
                            } else {
                                $csv_data->frec_cardiaca_min = $data [5];
                            }
                            if ($data [6] == '') {

                                $csv_data->velocidad_media = 0;
                            } else {
                                $csv_data->velocidad_media = $data [6];
                            }
                            if ($data [7] == '') {

                                $csv_data->velocidad_max = 0;
                            } else {
                                $csv_data->velocidad_max = $data [7];
                            }
                            if ($data [8] == '') {

                                $csv_data->velocidad_min = 0;
                            } else {
                                $csv_data->velocidad_min = $data [8];
                            }
                            if ($data [9] == '') {

                                $csv_data->recuento_pasos = 0;
                            } else {
                                $csv_data->recuento_pasos = $data [9];
                            }
                            if ($data [10] == '') {

                                $csv_data->peso_medio = 0;
                            } else {
                                $csv_data->peso_medio = $data [10];
                            }
                            if ($data [11] == '') {

                                $csv_data->peso_max = 0;
                            } else {
                                $csv_data->peso_max = $data [11];
                            }
                            if ($data [12] == '') {

                                $csv_data->peso_min = 0;
                            } else {
                                $csv_data->peso_min = $data [12];
                            }
                            if ($data [13] == '') {

                                $csv_data->recuento_min_activos = 0;
                            } else {
                                $csv_data->recuento_min_activos = $data [13];
                            }
                            if ($data [14] == '') {

                                $csv_data->andar_duracion = 0;
                            } else {
                                $csv_data->andar_duracion = $data [14];
                            }
                            if ($data [15] == '') {

                                $csv_data->dormir_duracion = 0;
                            } else {
                                $csv_data->dormir_duracion = $data [15];
                            }
                            $csv_data->paciente_id = Auth::user()->id - 1;
                            $csv_data->save();
                        }
                    }
                    fclose($handle);
                }

                $finalData= basedatos::all()->where('paciente_id',(Auth::user()->id)-1);

                View::share('finalData',$finalData);
                return view('pacientes.creat', ['pacientes' => $pacientes])->withData($finalData);
            }
        }

    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $medicos = Medico::all()->pluck('nombre','id');

        return view('pacientes/create',['medicos'=>$medicos]);
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
            'nombre' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'edad' => 'required|date',
            'peso' => 'required|max:255',
            'altura' => 'required|max:255',
            'sexo' => 'required|max:255',
            'operacion' => 'required|max:255',
            'tipo_paciente' => 'required|max:255',
            'medico_id' => 'required|exists:medicos,id'
    ]);
    $paciente = new Paciente($request->all());
    $paciente->save();

    // return redirect('especialidades');

    flash('paciente creado correctamente');

    return redirect()->route('pacientes.index');
}

  public function comparacion()
  {
      $id=Auth::user()->id-1;
      $pasosPaciente = Paso::where('fecha', '>', Carbon::now()->subDays(18))->where('paciente_id',$id)->get();
      $pasosOtros= Paso::where('fecha', '>', Carbon::now()->subDays(18))->where('paciente_id','!=',$id)->get();

      $data = collect([]);
      $data1 = collect([]);

      if($pasosPaciente->count() !== 0) {
          $data->push(($pasosPaciente->sum('num_pasos')) / $pasosPaciente->count());
          $data1->push('Media de pasos del paciente en los últimos 18 días');
      }else{
          $data->push(0);
          $data1->push('Aún no has importado datos con los pasos de los últimos 18 días');
      }
      if($pasosOtros->count() !==0){
          $data->push(($pasosOtros->sum('num_pasos')) / $pasosOtros->count());
          $data1->push('Media de pasos del resto de pacientes en los últimos 18 días');

      }else{
          $data->push(0);
          $data1->push('Aún hay datos guardados del resto de pacientes pertenecientes a los últimos 18 días');

      }



          $chart = Charts::database($data, 'bar', 'highcharts')
              ->title("Media de número de pasos en los últimos 18 días")
              ->elementLabel("Media de pasos")
              ->dimensions(1000, 500)
              ->labels($data1)
              ->values($data)
              ->responsive(true);
          return view('grafica',['chart'=>$chart]);
      }


      public function comparacion2(){

        $id= Auth::user()->id -1;


        if(Paciente::where('id',$id)->where('tipo_paciente','enfermo_despues')->count()==1){
            $data = collect([]);
            $data1 = collect([]);
            $a=Carbon::createFromTimeString((Paciente::where('id',$id)->pluck('updated_at'))[0])->toDate();
            $o=(Paciente::where('id',$id)->pluck('updated_at'))[0]->toDateTimeString();

            $cuenta=Paso::all()->where('paciente_id',$id)->where('fecha','>',$o)->count();
            $cuenta2=Paso::all()->where('paciente_id',$id)->where('fecha','<',$o)->count();
            $num_pasos=Paso::all()->where('paciente_id',$id)->where('fecha','>',$o)->sum('num_pasos');
            $num_pasos2=Paso::all()->where('paciente_id',$id)->where('fecha','<',$o)->sum('num_pasos');




            if($cuenta ==0 && $cuenta2==0){
                $data->push('No hay datos');
                $data1->push('No hay datos');
            }elseif ($cuenta==0){
                $data->push($num_pasos2/$cuenta2);
                $data->push('No hay datos después de la operacion');
                $data1->push('Media de pasos antes de la operacion');
                $data1->push('Media de pasos después de la operacion');
            }elseif($cuenta2==0){

                $data->push('No hay datos antes de la operacion');
                $data->push($num_pasos/$cuenta);
                $data1->push('Media de pasos antes de la operacion');
                $data1->push('Media de pasos después de la operacion');

            }else{
                $data->push($num_pasos2/$cuenta2);
                $data->push($num_pasos/$cuenta);
                $data1->push('Media de pasos antes de la operacion');
                $data1->push('Media de pasos después de la operacion');

            }
            $ante=Paso::all()->where('paciente_id',$id);
            $ante2=Paso::all()->where('paciente_id',$id)->where('fecha','<',$o);


          $chart= Charts::multi('line', 'highcharts')
                ->responsive(true)
                ->dimensions(0, 500)
                ->template("material")
                ->labels($ante->pluck('fecha'))
                ->title('Media de horas de sueño')
                ->yAxisTitle("Horas")
                ->dataset('Registro de horas de sueño', $ante->pluck('distancia'))
            ->dataset('Registro de horas de sueño', $ante->pluck('num_pasos'));

           /* $chart = Charts::database($data, 'bar', 'highcharts')
                ->title("Media de número de pasos antes y después de la operación")
                ->elementLabel("Media de pasos")
                ->dimensions(1000, 500)
                ->labels($data1)
                ->values($data)
                ->responsive(true);*/
            return view('grafica2',['chart'=>$chart]);

        }else{
            $data = collect([]);
            $data1 = collect([]);
            $data->push(0);
            $data1->push('No se puede mostrar la comparativa antes y despúes de la operación si no hay datos después de la operación');
            $chart = Charts::database($data, 'bar', 'highcharts')
                ->title("Media de número de pasos antes y despues de la operación")
                ->elementLabel("Media de pasos")
                ->dimensions(1000, 500)
                ->labels($data1)
                ->values($data)
                ->responsive(true);
          return view('grafica2',['chart'=>$chart]);
      }


        }
        public function ola(){
            dd("ola");
        }
        public function search(Request $request)
        {

            $search = $request->get('search');
            if (is_numeric($search)){
                //$pacientes = Paciente::where(parse('fecha')->format('d'), $search)->get();
               // date_parse_from_format('Y-m-d', '2010-11-24')['day'];
                $pacientes = Paciente::where('id', $search)->get();



            }else {

                $pacientes = Paciente::where('apellidos', 'like', '%' . $search . '%')->orWhere('operacion', 'like', '%' . $search . '%')->get();
            }
            return view('pacientes.index', ['pacientes' => $pacientes]);

        }
    public function search2(Request $request)
{

    $search = $request->get('search2');


    $pasos=Paso::whereDay('fecha','=',$search)->get();

    return view('pasos.table', ['pasos' => $pasos]);

}
    public function search3(Request $request)
    {

        $search = $request->get('search3');


        $registro_suenos=Registro_sueno::whereDay('fecha','=',$search)->get();

        return view('registro_suenos.table', ['registro_suenos' => $registro_suenos]);

    }
    public function search4(Request $request)
    {

        $search = $request->get('search4');


        $frecuencia_cardiacas=Frecuencia_cardiaca::whereDay('fecha','=',$search)->get();

        return view('frecuencia_cardiacas.table', ['frecuencia_cardiacas' => $frecuencia_cardiacas]);

    }




    public function comparacion3(){

        $id= Auth::user()->id -1;


        if(Paciente::where('id',$id)->where('tipo_paciente','enfermo_despues')->count()==1){
            $data = collect([]);
            $data1 = collect([]);
            $a=Carbon::createFromTimeString((Paciente::where('id',$id)->pluck('updated_at'))[0])->toDate();
            $o=(Paciente::where('id',$id)->pluck('updated_at'))[0]->toDateTimeString();

            $cuenta=Frecuencia_cardiaca::all()->where('paciente_id',$id)->where('fecha','>',$o)->where('frec_cardiaca_media','>',0)->count();
            $cuenta2=Frecuencia_cardiaca::all()->where('paciente_id',$id)->where('fecha','<',$o)->where('frec_cardiaca_media','>',0)->count();
            $num_pasos=Frecuencia_cardiaca::all()->where('paciente_id',$id)->where('fecha','>',$o)->where('frec_cardiaca_media','>',0)->sum('frec_cardiaca_media');
            $num_pasos2=Frecuencia_cardiaca::all()->where('paciente_id',$id)->where('fecha','<',$o)->where('frec_cardiaca_media','>',0)->sum('frec_cardiaca_media');




            if($cuenta ==0 && $cuenta2==0){
                $data->push(0);
                $data1->push('No hay datos');
            }elseif ($cuenta==0){
                $data->push($num_pasos2/$cuenta2);
                $data->push(0);
                $data1->push('Frecuencia cardiaca media antes de la operacion');
                $data1->push('Frecuencia cardiaca después de la operacion');
            }elseif($cuenta2==0){

                $data->push(0);
                $data->push($num_pasos/$cuenta);
                $data1->push('Frecuencia cardiaca media antes de la operacion');
                $data1->push('Frecuencia cardiaca después de la operacion');

            }else{
                $data->push($num_pasos2/$cuenta2);
                $data->push($num_pasos/$cuenta);
                $data1->push('Frecuencia cardiaca media antes de la operacion');
                $data1->push('Frecuencia cardiaca después de la operacion');

            }



            $chart = Charts::database($data, 'bar', 'highcharts')
                ->title("Frecuencia cardiaca media antes y después de la operación")
                ->elementLabel("Frecuencia cardiaca media")
                ->dimensions(1000, 500)
                ->labels($data1)
                ->values($data)
                ->responsive(true);
            return view('grafica3',['chart'=>$chart]);

        }else{
            $data = collect([]);
            $data1 = collect([]);
            $data->push(0);
            $data1->push('No se puede mostrar la comparativa antes y despúes de la operación si no hay datos después de la operación');
            $chart = Charts::database($data, 'bar', 'highcharts')
                ->title("Frecuencia cardiaca media antes y después de la operación")
                ->elementLabel("Frecuencia cardiaca media")
                ->dimensions(1000, 500)
                ->labels($data1)
                ->values($data)
                ->responsive(true);
            return view('grafica3',['chart'=>$chart]);

            /*olass*/
        }
    }
    public function git(){

    }
    public function comparacion4(){

        $id= Auth::user()->id -1;


        if(Paciente::where('id',$id)->where('tipo_paciente','enfermo_despues')->count()==1){
            $data = collect([]);
            $data1 = collect([]);
            $a=Carbon::createFromTimeString((Paciente::where('id',$id)->pluck('updated_at'))[0])->toDate();
            $o=(Paciente::where('id',$id)->pluck('updated_at'))[0]->toDateTimeString();

            $cuenta=Registro_sueno::all()->where('paciente_id',$id)->where('fecha','>',$o)->where('hosubras_sueno','>',0)->count();
            $cuenta2=Registro_sueno::all()->where('paciente_id',$id)->where('fecha','<',$o)->where('horas_sueno','>',0)->count();
            $num_pasos=Registro_sueno::all()->where('paciente_id',$id)->where('fecha','>',$o)->where('horas_sueno','>',0)->sum('horas_sueno');
            $num_pasos2=Registro_sueno::all()->where('paciente_id',$id)->where('fecha','<',$o)->where('horas_sueno','>',0)->sum('horas_sueno');



            if($cuenta ==0 && $cuenta2==0){
                $data->push(0);
                $data1->push('No hay datos');
            }elseif ($cuenta==0){
                $data->push($num_pasos2/$cuenta2);
                $data->push(0);
                $data1->push('Media de horas de sueño antes de la operacion');
                $data1->push('Media de horas de sueño  después de la operacion');
            }elseif($cuenta2==0){

                $data->push(0);
                $data->push($num_pasos/$cuenta);
                $data1->push('Media de horas de sueño antes de la operacion');
                $data1->push('Media de horas de sueño después de la operacion');

            }else{
                $data->push($num_pasos2/$cuenta2);
                $data->push($num_pasos/$cuenta);
                $data1->push('Media de horas de sueño antes de la operacion');
                $data1->push('Media de horas de sueño de la operacion');

            }



            $chart = Charts::database($data, 'bar', 'highcharts')
                ->title("Media de horas de sueño antes y después de la operación")
                ->elementLabel("Media de horas de sueño ")
                ->dimensions(1000, 500)
                ->labels($data1)
                ->values($data)
                ->responsive(true);
            return view('grafica4',['chart'=>$chart]);

        }else{
            $data = collect([]);
            $data1 = collect([]);
            $data->push(0);
            $data1->push('No se puede mostrar la comparativa antes y despúes de la operación si no hay datos después de la operación');
            $chart = Charts::database($data, 'bar', 'highcharts')
                ->title("Media de horas de sueño antes y después de la operación")
                ->elementLabel("Media de horas de sueño ")
                ->dimensions(1000, 500)
                ->labels($data1)
                ->values($data)
                ->responsive(true);
            return view('grafica4',['chart'=>$chart]);

            //


        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paciente = Paciente::find($id);

        $medicos = Medico::all()->pluck('nombre','id');


        return view('pacientes/edit',['paciente'=> $paciente, 'medicos'=>$medicos ]);
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
            'nombre' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'edad' => 'required|date',
            'peso' => 'required|max:255',
            'altura' => 'required|max:255',
            'sexo' => 'required|max:255',
            'operacion' => 'required|max:255',
            'tipo_paciente' => 'required|max:255',
            'medico_id' => 'required|exists:medicos,id'
        ]);

        $paciente = Paciente::find($id);
        $paciente->fill($request->all());

        $paciente->save();

        flash('paciente modificado correctamente');

        return redirect()->route('pacientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function infoPacientes($id){

        $data=basedatos::all()->where('paciente_id',$id);


        return view('infoPacientes',['data'=>$data]);


    }
    public function destroy($id)
    {   if ((Auth::user()->hasRole('admin'))) {

        $paciente = Paciente::find($id);
        $paciente->delete();
        flash('paciente borrado correctamente');

        return redirect()->route('pacientes.index');}
    else{
            flash('Sólo los médicos pueden borrar datos');
            return redirect()->route('pacientes.index');
        }
    }
    public function videos(Request $request){
        $search = $request->get('search4');
        $id=Auth::user()->id;
        $var="\n";
        $tipopaciente=Paciente::all()->where('id',$id)->get('tipo_paciente');
        if($tipopaciente != 'sano'){
            if(Paciente::where('id',$id)->where('operacion', 'like', '%' . $search . '%')->count() >0){


                    $var=$var."https://www.youtube.com/watch?v=IikPIs3xso0\n";
                    $var=$var."https://www.youtube.com/watch?v=SiPOBea-OL8&pbjreload=10\n";



            }else{

                $var='';
            }


        }
        return view ('ejercicios2',['var'=>$var]);
    }
}
