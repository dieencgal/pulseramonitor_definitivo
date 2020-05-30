<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\basedatos;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::resource('frecuencia_cardiacas', 'Frecuencia_cardiacaController');
Route::delete('medicos/destroyAll', 'MedicoController@destroyAll')->name('medicos.destroyAll');


Route::resource('medicos', 'MedicoController');
Route::resource('pacientes', 'PacienteController');
Route::resource('pasos', 'PasosController');
Route::resource('periodo_suenos', 'Periodo_suenoController');
Route::resource('registro_suenos', 'Registro_suenoController');
Route::resource('videos', 'VideoController');
Route::resource('encuesta','EncuestaController');
Route::resource('respuesta','RespuestaController');
Route::resource('encuesta_eqd5','EncuestaEQD5Controller');


Route::get('login2','HomeController@login2');
Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('login/google', 'Auth\LoginController@redirectToProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');


//Route::get('/prueba', 'HomeController@index');

Route::put('post/{id}', function ($id) {
    //o
})->middleware('auth', 'role:admin');

Route::get('import',  'ContactsController@import');
Route::post('import', 'ContactsController@parseImport');

Route::get('infoPacientes/{id}',  'PacienteController@infoPacientes');
Route::get('comparativas/{id}',  'PacienteController@comparativas');



Route::get('welcomebased',  'basedatosController@datos');
Route::get('pasos.indexdos',  'PasosController@datos');
Route::get('paciente/filtro','Registro_suenoController@filtrarpaciente')->name('pacientes.filtro');

Route::get('/intermedio', function () {
    return view('intermedio');
});
Route::get('/ejercicios', function () {
    return view('ejercicios');
});

Route::get('grafica',  'PacienteController@comparacion');
Route::get('grafica2',  'PacienteController@comparacion2');
Route::get('grafica3',  'PacienteController@comparacion3');
Route::get('grafica4',  'PacienteController@comparacion4');

Route::get('ayuda',  'PasosController@ayuda');
//Route::get('pacientes.table','PacienteController@filtraPacienteApellido')->name('pacientes.table');
Route::get('/search','PacienteController@search');
Route::get('/search2','PacienteController@search2');
Route::get('/search3','PacienteController@search3');
Route::get('/search4','PacienteController@search4');
Route::get('/search5','PacienteController@videos');

Route::get('videosindex',  'VideoController@index');

Route::get('/creat',  'PacienteController@index');
Route::get('Encuestas', function () {
    return view('Encuestas');
});













