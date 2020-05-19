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
use mysql_xdevapi\Collection;


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
            'fecha_operacion' => 'max:255',
            'tipo_paciente' => 'required|max:255',
            'medico_id' => 'required|exists:medicos,id'
    ]);
    $paciente = new Paciente($request->all());
    $paciente->save();

    // return redirect('especialidades');

    flash('paciente creado correctamente');

    return redirect()->route('pacientes.index');
}



 public function sanos(){
       $num=basedatos::all()->where('paciente_id',0)->groupBy('fecha')->count();
       $basedato=basedatos::all()->where('paciente_id',0);
       $i=0;
       $dum=collect([]);
       $media=collect([]);
       $fechas=collect([]);
       $dum->push(basedatos::all()->where('paciente_id',0)->groupBy('fecha'));
       while($i<$num-1){
           $fecha=($dum[0]->keys())[$i];
           $numero=basedatos::all()->where('paciente_id',0)->where('fecha',$fecha)->count();
           $numero_pasos=basedatos::all()->where('paciente_id',0)->where('fecha',$fecha)->sum('num_pasos');
           $media->push($numero_pasos/$numero);
           $fechas->push($fecha);

           $i=$i+1;

       }




 }
  public function comparacion()
  {
      $id=Auth::user()->id-1;
      $data = collect([]);
      $data1 = collect([]);
      $fecha=collect([]);
      $i=14;
      while ($i>0){
          $fecha->push(Carbon::now()->subDays($i)->toDateString());
          if(Paso::where('fecha',Carbon::now()->subDays($i)->toDateString())->where('paciente_id',$id)->count()==1){
              $data->push(Paso::where('fecha',Carbon::now()->subDays($i)->toDateString())->where('paciente_id',$id)->pluck('num_pasos'));
              $fecha->push(Carbon::now()->subDays($i)->toDateString());
          }else{
              $data->push(0);
          }
          if(Paso::where('fecha',Carbon::now()->subDays($i)->toDateString())->where('paciente_id','!=',$id)->count()>0){
              $data1->push((Paso::where('fecha',Carbon::now()->subDays($i)->toDateString())->where('paciente_id','!=',$id)->sum('num_pasos'))/Paso::where('fecha',Carbon::now()->subDays($i)->toDateString())->where('paciente_id','!=',$id)->count());
          }else{
              $data1->push(0);
          }
          $i=$i-1;
      }

      $chart = Charts::multi('line', 'highcharts')
          ->title("My Cool Chart")
          ->responsive(true)
          ->dimensions(0, 400) // Width x Height
          ->template("material")
          ->dataset('Tus pasos',$data)
          ->dataset('Media de pasos del resto de usuarios',$data1)
          ->labels($fecha);



          return view('grafica',['chart'=>$chart]);
      }


      public function comparacion2(){

        $id= Auth::user()->id -1;




            $pax=Paciente::where('id',$id);
            $fex=substr(($pax->pluck('fecha_operacion'))[0],0,10);

            $antes=Paso::all()->where('paciente_id',$id)->where('fecha','<',$fex)->where('fecha','>',date("Y-m-d", strtotime('-14 day ' , strtotime($fex))));
            $despues=Paso::all()->where('paciente_id',$id)->where('fecha','>=',$fex)->where('fecha','<',date("Y-m-d", strtotime('+14 day ' , strtotime($fex))));


            $antes2=Frecuencia_cardiaca::all()->where('paciente_id',$id)->where('fecha','<',$fex)->where('fecha','>',date("Y-m-d", strtotime('-14 day ' , strtotime($fex))))->where('frec_cardiaca_min','>',0);
            $despues2=Frecuencia_cardiaca::all()->where('paciente_id',$id)->where('fecha','>=',$fex)->where('fecha','<',date("Y-m-d", strtotime('+14 day ' , strtotime($fex))))->where('frec_cardiaca_min','>',0);


            $antes3=Registro_sueno::all()->where('paciente_id',$id)->where('fecha','<',$fex)->where('fecha','>',date("Y-m-d", strtotime('-14 day ' , strtotime($fex))))->where('horas_sueno','>',1);
            $despues3=Registro_sueno::all()->where('paciente_id',$id)->where('fecha','>=',$fex)->where('fecha','<',date("Y-m-d", strtotime('+14 day ' , strtotime($fex))))->where('horas_sueno','>',1);


            $id=Auth::user()->id-1;
            $data = collect([]);
            $data1 = collect([]);
            $data12 = collect([]);
            $fecha=collect([]);
            $i=14;
            while ($i>0){
                $fecha->push(Carbon::now()->subDays($i)->toDateString());
                if(Paso::where('fecha',Carbon::now()->subDays($i)->toDateString())->where('paciente_id',$id)->count()==1){
                    $data->push(Paso::where('fecha',Carbon::now()->subDays($i)->toDateString())->where('paciente_id',$id)->pluck('num_pasos'));
                    $fecha->push(Carbon::now()->subDays($i)->toDateString());
                }else{
                    $data->push(0);
                }
                if(Paso::where('fecha',Carbon::now()->subDays($i)->toDateString())->where('paciente_id','!=',$id)->count()>0){
                    $data1->push((Paso::where('fecha',Carbon::now()->subDays($i)->toDateString())->where('paciente_id','!=',$id)->sum('num_pasos'))/Paso::where('fecha',Carbon::now()->subDays($i)->toDateString())->where('paciente_id','!=',$id)->count());
                }else{
                    $data1->push(0);
                }


                $i=$i-1;
            }
            $is=14;
            $pa= Paciente::all()->where('tipo_paciente','sano')->pluck('id');
            $t=array();
            foreach($pa as $p){

                    $t=(Paso::all()->where('paciente_id', $p)->pluck('num_pasos', 'fecha'));

            }


            $char = Charts::multi('line', 'highcharts')
                ->title("Comparación de pasos frente al resto de pacientes")
                ->responsive(true)
                ->dimensions(0, 400) // Width x Height
                ->template("material")
                ->yAxisTitle("Recuento de pasos")
                ->dataset('Tus pasos',$data)
                ->dataset('Media de pasos del resto de usuarios',$data1)
                ->labels($fecha);

            $chart3= Charts::multi('line', 'highcharts')
                ->responsive(true)
                ->dimensions(0, 500)
                ->template("material")
                ->labels(['1','2','3','4','5','6','7','8','9','10','11','12','13','14'])
                ->Title('Registros del sueño antes y después de la operación ('.$fex.')')
                ->yAxisTitle("Horas")
                ->dataset('Horas de sueño 14 días antes de la operación',$antes3->pluck('horas_sueno'))
                ->dataset('Horas de sueño 14 días después de la operación',$despues3->pluck('horas_sueno'));

            $chart2= Charts::multi('line', 'highcharts')
                ->responsive(true)
                ->dimensions(0, 500)
                ->template("material")
                ->labels(['1','2','3','4','5','6','7','8','9','10','11','12','13','14'])
                ->Title('Registros de la frecuencia antes y después de la operación ('.$fex.')')
                ->yAxisTitle("Pulsaciones por minuto")
                ->dataset('Frecuencia cardíaca en reposo 14 días antes de la operación',$antes2->pluck('frec_cardiaca_min'))
                ->dataset('Frecuencia cardíaca en reposo 14 días después de la operación',$despues2->pluck('frec_cardiaca_min'))
                ->dataset('Frecuencia cardíaca media 14 días antes de la operación',$antes2->pluck('frec_cardiaca_media'))
                ->dataset('Frecuencia cardíaca media 14 días después de la operación',$despues2->pluck('frec_cardiaca_media'))
                ->colors(['#FF0000','#FFFF00','#FF0000','#FFFF00']);

          $chart= Charts::multi('line', 'highcharts')
                ->responsive(true)
                ->dimensions(0, 500)
                ->template("material")
                ->labels(['1','2','3','4','5','6','7','8','9','10','11','12','13','14'])
                ->Title('Pasos antes y después de la operación ('.$fex.')')
                ->yAxisTitle("Recuento de pasos")
                ->dataset('Pasos 14 días antes de la operación',$antes->pluck('num_pasos'))
                ->dataset('Pasos 14 días después de la operación',$despues->pluck('num_pasos'));
            $e= basedatos::all()->where('paciente_id',Auth::user()->id-1)->where('recuento_min_activos','>',10);

            $usersChart = Charts::database($e->pluck('recuento_min_activos'), 'bar', 'highcharts')
                ->title("Recuento de minutos activos")
                ->elementLabel("Minutos activos")
                ->dimensions(1000, 500)
                ->yAxisTitle("Minutos")
                ->labels($e->pluck('fecha'))
                ->values($e->pluck('recuento_min_activos'))
                ->colors(['#FF0000'])
                ->responsive(true);





            return view('grafica2',['chart'=>$chart,'chart2'=>$chart2,'chart3'=>$chart3,'char'=>$char,'usersChart'=>$usersChart]);

        /*}else{
            $id=Auth::user()->id-1;
            $data = collect([]);
            $data1 = collect([]);
            $fecha=collect([]);
            $i=14;
            $e= basedatos::all()->where('paciente_id',Auth::user()->id-1)->where('recuento_min_activos','>',10);

            $usersChart = Charts::database($e->pluck('recuento_min_activos'), 'bar', 'highcharts')
                ->title("Recuento de minutos activos")
                ->elementLabel("Minutos activos")
                ->dimensions(1000, 500)
                ->yAxisTitle("Minutos")
                ->labels($e->pluck('fecha'))
                ->values($e->pluck('recuento_min_activos'))
                ->colors(['#FF0000'])
                ->responsive(true);



            while ($i>0){
                $fecha->push(Carbon::now()->subDays($i)->toDateString());
                if(Paso::where('fecha',Carbon::now()->subDays($i)->toDateString())->where('paciente_id',$id)->count()==1){
                    $data->push(Paso::where('fecha',Carbon::now()->subDays($i)->toDateString())->where('paciente_id',$id)->pluck('num_pasos'));
                    $fecha->push(Carbon::now()->subDays($i)->toDateString());
                }else{
                    $data->push(0);
                }
                if(Paso::where('fecha',Carbon::now()->subDays($i)->toDateString())->where('paciente_id','!=',$id)->count()>0){
                    $data1->push((Paso::where('fecha',Carbon::now()->subDays($i)->toDateString())->where('paciente_id','!=',$id)->sum('num_pasos'))/Paso::where('fecha',Carbon::now()->subDays($i)->toDateString())->where('paciente_id','!=',$id)->count());
                }else{
                    $data1->push(0);
                }
                $i=$i-1;
            }

            $char = Charts::multi('line', 'highcharts')
                ->title("Comparación de pasos frente al resto de pacientes")
                ->responsive(true)
                ->dimensions(0, 400) // Width x Height
                ->template("material")
                ->yAxisTitle("Recuento de pasos")
                ->dataset('Tus pasos',$data)
                ->dataset('Media de pasos del resto de usuarios',$data1)
                ->labels($fecha);
            $dat = collect([]);
            $dat1 = collect([]);
            $dat->push(0);
            $dat1->push('No hay datos antes y después de la operación');
            $chart = Charts::database($dat, 'bar', 'highcharts')
                ->title("Media de número de pasos antes y despues de la operación")
                ->elementLabel("Media de pasos")
                ->dimensions(1000, 500)
                ->labels($dat1)
                ->values($dat)
                ->responsive(true);
            $da = collect([]);
            $da1 = collect([]);
            $da->push(0);
            $da1->push('No se puede mostrar la comparativa antes y despúes de la operación si no hay datos después de la operación');
            $chart2 = Charts::database($da, 'bar', 'highcharts')
                ->title("Frecuencia cardiaca media antes y después de la operación")
                ->elementLabel("Frecuencia cardiaca media")
                ->dimensions(1000, 500)
                ->labels($da1)
                ->values($da)
                ->responsive(true);
            $ata = collect([]);
            $ata1 = collect([]);
            $ata->push(0);
            $ata1->push('No se puede mostrar la comparativa antes y despúes de la operación si no hay datos después de la operación');
            $chart3 = Charts::database($ata, 'bar', 'highcharts')
                ->title("Media de horas de sueño antes y después de la operación")
                ->elementLabel("Media de horas de sueño ")
                ->dimensions(1000, 500)
                ->labels($ata1)
                ->values($ata)
                ->responsive(true);

            return view('grafica2',['chart'=>$chart,'chart2'=>$chart2,'chart3'=>$chart3,'char'=>$char,'usersChart'=>$usersChart]);
      }*/


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
    $pac=Paciente::where('apellidos',$search)->pluck('id');
    if($pac->count()>0) {
        $num=basedatos::all()->where('paciente_id',0)->where('fecha','>',Carbon::now()->subDays(28)->toDateString())->groupBy('fecha')->count();

        $basedato=basedatos::all()->where('paciente_id',0)->first();
        $i=0;
        $dum=collect([]);
        $media=collect([]);
        $fechas=collect([]);
        $dum->push(basedatos::all()->where('paciente_id',0)->where('fecha','>',Carbon::now()->subDays(28)->toDateString())->groupBy('fecha'));
        while($i<$num-1){
            $fecha=($dum[0]->keys())[$i];
            $numero=basedatos::all()->where('paciente_id',0)->where('fecha',$fecha)->count();

            $numero_pasos=basedatos::all()->where('paciente_id',0)->where('fecha',$fecha)->sum('recuento_pasos');

            $media->push($numero_pasos/$numero);
            $fechas->push($fecha);

            $i=$i+1;

        }




        $pasos = Paso::all()->where('paciente_id', $pac[0])->where('fecha','>', Carbon::now()->subDays(28)->toDateString());

        $chart = Charts::multi('line', 'highcharts')
            ->responsive(true)
            ->dimensions(0, 500)
            ->template("material")
            ->labels($pasos->pluck('fecha'))
            ->title('Recuento de pasos del paciente ' . $search . '')
            ->yAxisTitle("Número de pasos")
            ->dataset('Recuento de pasos diarios', $pasos->pluck('num_pasos'))
            ->dataset('Recuento de pasos diarios población sana', $media);



        return view('pasos.index', ['pasos' => $pasos, 'chart' => $chart]);
    }else{
        $pasos = Paso::all();
        $data = collect([]);
        $data1 = collect([]);// Could also be an array
        $users= Paciente::all();

        foreach ($users as $user) {
            // Could also be an array_push if using an array rather than a collection.
            $data->push(Paso::all()->where('paciente_id',($user->id))->where('fecha','>',Carbon::now()->subDays(28)->toDateString())->sum('num_pasos'));
            $data1->push("".$user->apellidos.",".$user->nombre."");
        }

        $pacientes = Paciente::all();



        $products = Paso::all();
        $chart = Charts::database($data, 'bar', 'highcharts')
            ->title("Pasos por paciente")
            ->elementLabel("Pasos del paciente")
            ->dimensions(1000, 500)
            ->labels($data1)
            ->values($data)
            ->responsive(true)

        ;

        return view('pasos.index', ['pasos' => $pasos,'chart'=>$chart]);

    }

}
    public function search3(Request $request)
    {

        $search = $request->get('search3');
        $pac = Paciente::where('apellidos', $search)->pluck('id');


        if ($pac->count() > 0) {
            $num = basedatos::all()->where('paciente_id', 0)->where('dormir_duracion', '>', 0)->where('fecha', '>', Carbon::now()->subDays(28)->toDateString())->groupBy('fecha')->count();

            $basedato = basedatos::all()->where('paciente_id', 0)->first();
            $i = 0;
            $dum = collect([]);
            $media = collect([]);
            $fechas = collect([]);
            $dum->push(basedatos::all()->where('paciente_id', 0)->where('dormir_duracion', '>', 0)->where('fecha', '>', Carbon::now()->subDays(28)->toDateString())->groupBy('fecha'));
            while ($i < $num - 1) {
                $fecha = ($dum[0]->keys())[$i];
                $numero = basedatos::all()->where('paciente_id', 0)->where('fecha', $fecha)->where('fecha', '>', Carbon::now()->subDays(28)->toDateString())->pluck('dormir_duracion')->count();
                $numero_pasos = basedatos::all()->where('paciente_id', 0)->where('fecha', $fecha)->sum('dormir_duracion');


                $media->push($numero_pasos/$numero);
                $fechas->push($fecha);


            $i = $i + 1;

        }


        $registro_suenos = Registro_sueno::all()->where('paciente_id', $pac[0])->where('horas_sueno', '>', 1)->where('fecha', '>', Carbon::now()->subDays(28)->toDateString());
        $chart = Charts::multi('line', 'highcharts')
            ->responsive(true)
            ->dimensions(0, 500)
            ->template("material")
            ->labels($registro_suenos->pluck('fecha'))
            ->title('Horas de sueño del paciente ' . $search . '')
            ->yAxisTitle("Horas")
            ->dataset('Registro horas de sueño', $registro_suenos->pluck('horas_sueno'))
            ->dataset('Registro horas de sueño población sana', $media);;


        return view('registro_suenos.index', ['registro_suenos' => $registro_suenos, 'chart' => $chart]);
     }else{
            $registro_suenos = Registro_sueno::all();
            $data = collect([]);

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
        }

    }
    public function search4(Request $request)
    {

        $search = $request->get('search4');
        $pac=Paciente::where('apellidos',$search)->pluck('id');
        if($pac->count()>0) {
            $frecuencia_cardiacas=Frecuencia_cardiaca::all()->where('paciente_id', $pac[0]);
            $frecuencia_cardiacas2 = Frecuencia_cardiaca::where('paciente_id', $pac[0])->where('frec_cardiaca_min', '>', 0)->where('fecha','>',Carbon::now()->subDays(28)->toDateString());
            $chart = Charts::multi('line', 'highcharts')
                ->responsive(true)
                ->dimensions(0, 500)
                ->template("material")
                ->labels($frecuencia_cardiacas2->pluck('fecha'))
                ->title('Registros de la frecuencia cardíaca en los últimos 30 días del paciente '  . $search .'')
                ->yAxisTitle("Pulsaciones por minuto")
                ->dataset('Frecuencia cardíaca media máxima', $frecuencia_cardiacas2->pluck('frec_cardiaca_max'))
                ->dataset('Frecuencia cardíaca media', $frecuencia_cardiacas2->pluck('frec_cardiaca_media'))
                ->dataset('Frecuencia cardíaca media mínima', $frecuencia_cardiacas2->pluck('frec_cardiaca_min'));

            return view('frecuencia_cardiacas.index', ['frecuencia_cardiacas' => $frecuencia_cardiacas, 'chart' => $chart]);
        }else {
            $frecuencia_cardiacas = Frecuencia_cardiaca::all();
            $data = collect([]);
            $data2 = collect([]);
            $data1 = collect([]);// Could also be an array
            $users = Paciente::all();

            foreach ($users as $user) {
                $cuanta = 0;
                $cuanta = Frecuencia_cardiaca::all()->where('paciente_id', ($user->id))->where('frec_cardiaca_media', '>', 0)->count();
                if ($cuanta !== 0) {
                    $data->push(Frecuencia_cardiaca::all()->where('paciente_id', ($user->id))->sum('frec_cardiaca_media') / $cuanta);
                    $data2->push(Frecuencia_cardiaca::all()->where('paciente_id', ($user->id))->max());
                    $data1->push($user->id);
                }
            }

            $chart = Charts::database($data, 'bar', 'highcharts')
                ->title("Frecuencia cardíaca media de los pacientes")
                ->elementLabel("Frecuencia cardíaca del paciente")
                ->dimensions(1000, 500)
                ->labels($data1)
                ->values($data)
                ->responsive(true);
            return view('frecuencia_cardiacas.index', ['frecuencia_cardiacas' => $frecuencia_cardiacas, 'chart' => $chart]);
        }

    }




    public function comparacion3(){

        $id= Auth::user()->id -1;


        if(Paciente::where('id',$id)->where('tipo_paciente','enfermo')->count()==1){

            $pax=Paciente::where('id',$id);
            $fex=substr(($pax->pluck('fecha_operacion'))[0],0,10);

            $antes=Frecuencia_cardiaca::all()->where('paciente_id',$id)->where('fecha','<',$fex)->where('fecha','>',date("Y-m-d", strtotime('-14 day ' , strtotime($fex))))->where('frec_cardiaca_min','>',0);
            $despues=Frecuencia_cardiaca::all()->where('paciente_id',$id)->where('fecha','>=',$fex)->where('fecha','<',date("Y-m-d", strtotime('+14 day ' , strtotime($fex))))->where('frec_cardiaca_min','>',0);




            $chart= Charts::multi('line', 'highcharts')
                ->responsive(true)
                ->dimensions(0, 500)
                ->template("material")
                ->labels(['1','2','3','4','5','6','7','8','9','10','11','12','13','14'])
                ->Title('Registros de la frecuencia antes y después de la operación ('.$fex.')')
                ->yAxisTitle("Pulsaciones por minuto")
                ->dataset('Frecuencia cardíaca en reposo 14 días antes de la operación',$antes->pluck('frec_cardiaca_min'))
                ->dataset('Frecuencia cardíaca en reposo 14 días después de la operación',$despues->pluck('frec_cardiaca_min'))
                ->dataset('Frecuencia cardíaca media 14 días antes de la operación',$antes->pluck('frec_cardiaca_media'))
                ->dataset('Frecuencia cardíaca media 14 días después de la operación',$despues->pluck('frec_cardiaca_media'))
                ->colors(['#FF0000','#FFFF00','#FF0000','#FFFF00']);




            return view('grafica3',['chart'=>$chart]);

        }else{
            $da = collect([]);
            $da1 = collect([]);
            $da->push(0);
            $da1->push('No se puede mostrar la comparativa antes y despúes de la operación si no hay datos después de la operación');
            $chart = Charts::database($da, 'bar', 'highcharts')
                ->title("Frecuencia cardiaca media antes y después de la operación")
                ->elementLabel("Frecuencia cardiaca media")
                ->dimensions(1000, 500)
                ->labels($da1)
                ->values($da)
                ->responsive(true);
            return view('grafica3',['chart'=>$chart]);

            /*olass*/
        }
    }
    public function git(){

    }
    public function comparacion4(){
        $id= Auth::user()->id -1;


        if(Paciente::where('id',$id)->where('tipo_paciente','enfermo')->count()==1){

            $pax=Paciente::where('id',$id);
            $fex=substr(($pax->pluck('fecha_operacion'))[0],0,10);

            $antes=Registro_sueno::all()->where('paciente_id',$id)->where('fecha','<',$fex)->where('fecha','>',date("Y-m-d", strtotime('-14 day ' , strtotime($fex))))->where('horas_sueno','>',1);
            $despues=Registro_sueno::all()->where('paciente_id',$id)->where('fecha','>=',$fex)->where('fecha','<',date("Y-m-d", strtotime('+14 day ' , strtotime($fex))))->where('horas_sueno','>',1);




            $chart= Charts::multi('line', 'highcharts')
                ->responsive(true)
                ->dimensions(0, 500)
                ->template("material")
                ->labels(['1','2','3','4','5','6','7','8','9','10','11','12','13','14'])
                ->Title('Registros del sueño antes y después de la operación ('.$fex.')')
                ->yAxisTitle("Horas")
                ->dataset('Horas de sueño 14 días antes de la operación',$antes->pluck('horas_sueno'))
                ->dataset('Horas de sueño 14 días después de la operación',$despues->pluck('horas_sueno'));


            return view('grafica4',['chart'=>$chart]);

        }else{
            $ata = collect([]);
            $ata1 = collect([]);
            $ata->push(0);
            $ata1->push('No se puede mostrar la comparativa antes y despúes de la operación si no hay datos después de la operación');
            $chart = Charts::database($ata, 'bar', 'highcharts')
                ->title("Media de horas de sueño antes y después de la operación")
                ->elementLabel("Media de horas de sueño ")
                ->dimensions(1000, 500)
                ->labels($ata1)
                ->values($ata)
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
            'fecha_operacion'=> 'required|max:255',
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
