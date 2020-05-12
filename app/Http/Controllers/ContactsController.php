<?php

namespace App\Http\Controllers;
use App\basedatos;
use App\Paciente;
use File;
use Auth;





class ContactsController extends Controller
{

    public function import()
    {
        $records = [];

        $path = base_path('/resources/carpetaPacientes/pendingcontacts/'.Auth::user()->name);


        foreach (glob($path.'/*.csv') as $file) {
            $file = new \SplFileObject($file, 'r');
            $file->seek(PHP_INT_MAX);
            $records[] = $file->key();
        }
        $toImport = array_sum($records);

        return view('import', compact('toImport'));
    }

    public function parseImport()
    {
        if(!File::exists('/resources/carpetaPacientes/pendingcontacts/'.Auth::user()->name)) {
            File::makeDirectory(base_path('/resources/carpetaPacientes/pendingcontacts/'.Auth::user()->name), $mode = 0777, true, true);

        }


        request()->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        //get file from upload
        $path = request()->file('file')->getRealPath();


        //turn into array
        $file = file($path);

        //remove first line
        $data = array_slice($file, 1);
        //Para que salgan los headers
        //$data = array_slice($file, 0);

        //loop through file and split every 1000 lines
        $parts = (array_chunk($data, 1000));
        $i = 1;


        foreach($parts as $line) {
            $filename = base_path('/resources/carpetaPacientes/pendingcontacts/'.Auth::user()->name.'/'.date('y-m-d-H-i-s').$i.'.csv');
            file_put_contents($filename, $line);
            $i++;
        }
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


        session()->flash('status', 'queued for importing');


        /*return redirect("import");*/
        $files = scandir(base_path('/resources/carpetaPacientes/pendingcontacts/' . \Illuminate\Support\Facades\Auth::user()->name . ''), SCANDIR_SORT_DESCENDING);

        $fil=substr($files[0], 6, 2);
        $fil1=substr($files[0], 4, 2);
        $fil3=substr($files[0], 0, 2);

        $fil2=substr($files[0], 9, 5);
        $var = "La última vez que importó sus datos fué el $fil/$fil1/$fil3 , no olvide importar sus datos al menos una vez cada dos semanas";
        $pacientes = Paciente::all()->where('id', (\Illuminate\Support\Facades\Auth::user()->id) - 1);
        return view('home',['pacientes'=>$pacientes,'var'=>$var]);
    }
}
