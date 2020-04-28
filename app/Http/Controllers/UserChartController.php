<?php

namespace App\Http\Controllers;



use App\Charts\SampleChart;
use App\Paciente;
use Illuminate\Http\Request;
use App\Product;
use Charts;
use App\Paso;
use DB;

class UserChartController extends Controller
{
    public function index()
    {
        /*$products = Paso::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y'))->where('paciente_id',2)->get();*/
        $products = Paso::where('paciente_id', (Auth::user()->id) - 1);

        $chart = Charts::database($products, 'bar', 'highcharts')
            ->title('Pasos')
            ->elementLabel('Pasos')
            ->dimensions(1000, 500)
            ->labels($products->pluck('fecha'))
            ->values($products->pluck('num_pasos'))
            ->responsive(true);
        return view('grafica', ['chart' => $chart]);
    }


}
