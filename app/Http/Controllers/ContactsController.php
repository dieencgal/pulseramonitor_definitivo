<?php

namespace App\Http\Controllers;
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

        //loop through file and split every 1000 lines
        $parts = (array_chunk($data, 1000));
        $i = 1;


        foreach($parts as $line) {
            $filename = base_path('/resources/carpetaPacientes/pendingcontacts/'.Auth::user()->name.'/'.date('y-m-d-H-i-s').$i.'.csv');
            file_put_contents($filename, $line);
            $i++;
        }


        session()->flash('status', 'queued for importing');


        /*return redirect("import");*/
        $files = scandir(base_path('/resources/carpetaPacientes/pendingcontacts/' . \Illuminate\Support\Facades\Auth::user()->name . ''), SCANDIR_SORT_DESCENDING);

        $fil=substr($files[0], 0, 8);
        $fil2=substr($files[0], 9, 5);
        $var = "La última vez que importó sus datos fué el $fil a las $fil2, no olvide importar sus datos al menos una vez cada dos semanas";
        $pacientes = Paciente::all()->where('id', (\Illuminate\Support\Facades\Auth::user()->id) - 1);
        return view('home',['pacientes'=>$pacientes,'var'=>$var]);
    }
}
