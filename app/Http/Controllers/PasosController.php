<?php

namespace App\Http\Controllers;

use App\basedatos;
use App\Paso;
use App\Paciente;
use App\User;
use Auth;


use Carbon\Carbon;
use ConsoleTVs\Charts\Builder\Chart;
use ConsoleTVs\Charts\Facades\Charts;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PasosController extends Controller
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

    public function ayuda(){
        return view('ayuda');
    }

    public function index()

    {
        if ((Auth::user()->hasRole('admin'))) {
            $pasos = Paso::all();
            $data = collect([]);
            $data1 = collect([]);// Could also be an array
            $users= Paciente::all();

            foreach ($users as $user) {
                // Could also be an array_push if using an array rather than a collection.
                $data->push(Paso::all()->where('paciente_id',($user->id))->sum('num_pasos'));
                //->where('fecha','>',Carbon::now()->subDays(28)->toDateString())
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
                    //abajo del todo estara comentado la otra forma de hacer index admin
        } else {

            $files = scandir(base_path('/resources/carpetaPacientes/pendingcontacts/' . \Illuminate\Support\Facades\Auth::user()->name . ''), SCANDIR_SORT_DESCENDING);
            $newest_file = base_path('/resources/carpetaPacientes/pendingcontacts/' . Auth::user()->name . '/' . $files[0]);
            $pacientes = Paciente::all()->where('id', (Auth::user()->id) - 1)->pluck('id');

            if (($handle = fopen($newest_file, 'r')) !== FALSE) {
                while (($data = fgetcsv($handle, 2000, ',')) !== FALSE) {
                    $dateExists = Paso::where('fecha', $data[0])->where('paciente_id', (Auth::user()->id) - 1)->first();
                    if (!$dateExists) {
                        $csv_data = new Paso ();
                        $csv_data->fecha = $data [0];
                        if ($data [2] == '') {

                            $csv_data->distancia = 0;
                        } else {
                            $csv_data->distancia = $data [2];
                        }

                        if ($data [9] == '') {

                            $csv_data->num_pasos = 0;
                        } else {
                            $csv_data->num_pasos = $data [9];
                        }
                        $csv_data->paciente_id = \Illuminate\Support\Facades\Auth::user()->id - 1;
                        $csv_data->save();

                    }
                }

                fclose($handle);
            }
            $pasos = Paso::all()->where('paciente_id', (Auth::user()->id) - 1)->where('num_pasos','>',0);;
            $products= Paso::where('paciente_id',(Auth::user()->id)-1);
            $product=Paso::where('paciente_id',(Auth::user()->id)-1)->where('num_pasos','>=',9000);
            $product2=Paso::where('paciente_id',(Auth::user()->id)-1)->where('num_pasos','<',9000);





           /* $chart = Charts::database($products, 'bar', 'highcharts')
                ->title('Pasos')
                ->elementLabel('Pasos')
                ->dimensions(1000, 500)
                ->labels($products->pluck('fecha'))
                ->values($products->pluck('num_pasos'))
                ->responsive(true);*/
            /*$chart = new Chart();
            $chart->title("First Response Time");
            $chart->labels($products->pluck('fecha'));
            $chart->dataset('Daily Visitors Bar', 'bar', $products->pluck('num_pasos') )->color('white')->backgroundColor(['#009900','#8a8a5c','#f1c40f','#e67e22','#16a085','#2980b9']);

            $chart->height(500);*/
           $chart= Charts::multi('line', 'highcharts')
               ->responsive(true)
               ->dimensions(0, 500)
               ->template("material")
               ->labels($products->pluck('fecha'))
               ->title('Recuento de pasos')
               ->yAxisTitle("Número de pasos")
               ->dataset('Recuento de pasos diarios', $products->pluck('num_pasos'));

            /*$chart = Charts::create('line', 'highcharts')
                ->title('Line Chart Demo')
                ->elementLabel('Chart Labels')
                ->labels($products->pluck('fecha'))
                ->values($products->pluck('num_pasos'))
                ->dimensions(1000,500)
                ->responsive(true);*/
            $pacientes=Paciente::where('id',Auth::user()->id-1)->pluck('apellidos','id');


            return view('pasos.index', ['pasos' => $pasos,'chart' => $chart,'pacientes'=>$pacientes]);




        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        if ((Auth::user()->hasRole('admin'))){
               $pacientes = Paciente::all()->pluck('nombre','id');
            return view('pasos/create', ['pacientes' => $pacientes]);
        }

    else{

        $pacientes = Paciente::all()->where('id',(Auth::user()->id)-1)->pluck('id');


        return view('pasos/create', ['pacientes' => $pacientes[0]]);
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
            'num_pasos' => 'required|max:255',
            'distancia' => 'required|max:255',
            'paciente_id' => 'required|exists:pacientes,id'
        ]);
        $pasos = new Paso($request->all());
        $pasos->save();

        // return redirect('especialidades');

        flash('Los pasos se han creado correctamente');

        return redirect()->route('pasos.index');
    }

    public function show(Paso $pasos)
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
        $pasos = Paso::find($id);

        $paciente = Paciente::all()->pluck('nombre','id');


        return view('pasos/edit',['paso'=> $pasos, 'paciente'=>$paciente ]);
    }





    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'fecha' => 'required|date',
            'distancia' => 'required|max:255',
            'num_pasos' => 'required|max:255',
            'paciente_id' => 'required|exists:pacientes,id'
        ]);


        $paso = Paso::find($id);
        $paso->fill($request->all());

        $paso->save();

        flash('Los pasos se han modificado correctamente');

        return redirect()->route('pasos.index');
    }


    public function destroy($id)
    {
        if ((Auth::user()->hasRole('admin'))) {
        $paso = Paso::find($id);
        $paso->delete();
        flash('Los pasos se han borrado correctamente');

        return redirect()->route('pasos.index');
        }
        else{
            flash('Sólo los médicos pueden borrar datos');
            return redirect()->route('pasos.index');
        }

    }
    public function datos(){
        $files = scandir(base_path('/resources/carpetaPacientes/pendingcontacts/'. \Illuminate\Support\Facades\Auth::user()->name.''), SCANDIR_SORT_DESCENDING);
        $newest_file= base_path('/resources/carpetaPacientes/pendingcontacts/'.Auth::user()->name.'/'.$files[0]);
        if (($handle = fopen($newest_file, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 2000, ',')) !== FALSE) {
                $csv_data = new basedatos ();
                $csv_data->fecha = $data [0];
                $csv_data->distancia = $data [2];

                if($data [9]==''){

                    $csv_data->recuento_pasos = 0;
                }else {
                    $csv_data->recuento_pasos= $data [9];
                }
                $csv_data ->paciente_id= Auth::user()->id-1;
                $csv_data->save();
            }
                  fclose($handle);
        }
        $finalData = $csv_data::all();
        return view('pasos.indexdos')->withData ( $finalData );
    }

/*  $files = glob(base_path("resources/carpetaPacientes/pendingcontacts/*"));

            foreach ($files as $fil) {
                $nombre = basename($fil);
                $user = User::where('name', $nombre)->first();
                if ($user !== null) {
                    $arch = scandir(base_path('/resources/carpetaPacientes/pendingcontacts/' . $nombre . ''), SCANDIR_SORT_DESCENDING);

                    $newest_file = base_path('/resources/carpetaPacientes/pendingcontacts/' . $nombre . '/' . $arch[0]);


                    if (($handle = fopen($newest_file, 'r')) !== FALSE) {
                        while (($data2 = fgetcsv($handle, 2000, ',')) !== FALSE) {

                            $csv_data2 = new Paso ();

                            $csv_data2->fecha = $data2 [0];

                            $csv_data2->distancia = $data2 [2];

                            if ($data2 [9] == '') {

                                $csv_data2->num_pasos = 0;
                            } else {
                                $csv_data2->num_pasos = $data2 [9];
                            }
                            $csv_data2->paciente_id = ($user->id) - 1;

                            /*if (Paso::all()->where('fecha','=',$data2 [0])->count() == 0 ){
$csv_data2->save();


}
fclose($handle);
}
$pasos = $csv_data2::all();*/

}
