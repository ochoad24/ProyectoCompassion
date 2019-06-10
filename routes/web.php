<?php

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
Route::group(['middleware'=>['guest']],function(){
    Route::get('/login','Auth\LoginController@showLoginForm');
    Route::post('/login','Auth\LoginController@login')->name('login');
});


//Rutas del Nivel
Route::group(['middleware'=>['auth']],function(){
    Route::get('/', function () {
        return view('content');
    });
    Route::post('/logout','Auth\LoginController@logout')->name('logout');
    Route::get('/Nivel','NivelController@index');
    Route::post('/Nivel/nuevo','NivelController@store');
    Route::put('/Nivel/editar','NivelController@edit');
    Route::delete('/Nivel/{nivel}/delete', 'NivelController@drop');

    //Rutas del Responsable
    Route::get('/Responsable','ResponsableController@index');
    Route::post('/Responsable/nuevo','ResponsableController@store');
    Route::put('/Responsable/editar','ResponsableController@edit');
    Route::delete('/Responsable/{responsable}/delete', 'ResponsableController@drop');

    //Rutas del Alumno
    Route::get('/Alumno','AlumnoController@index');
    Route::post('/Alumno/nuevo','AlumnoController@store');
    Route::put('/Alumno/editar','AlumnoController@edit');
    Route::delete('/Alumno/{alumno}/delete', 'AlumnoController@drop');
    //Select Para el Alumno
    Route::get('/Nivel/select','NivelController@select');
    Route::get('/Responsable/select','ResponsableController@select');

    //Rutas de la Morbilidad
    Route::get('/Morbilidad','MorbilidadController@index');
    Route::post('/Morbilidad/nuevo','MorbilidadController@store');
    Route::put('/Morbilidad/editar','MorbilidadController@edit');
    Route::post('/Morbilidad/delete', 'MorbilidadController@drop');

    //Rutas de la Gasto
    Route::get('/Gasto','GastoController@index');
    Route::get('/Gasto/detalle','GastoController@detalle');
    Route::post('/Gasto/nuevo','GastoController@store');
    Route::post('/Gasto/delete', 'GastoController@drop');

    //Select para el Gasto
    Route::get('/Alumno/select','AlumnoController@select');

    //Rutas para los datos de Peso y Altura de cada Niño
    Route::get('/Datos','DatosController@index');
    Route::post('/Datos/nuevo','DatosController@store');
    Route::put('/Datos/editar','DatosController@edit');
    Route::post('/Datos/delete', 'DatosController@drop');

    //Rutas para el Diagnostico
    Route::get('/Diagnostico','DiagnosticoController@index');
    Route::post('/Diagnostico/nuevo','DiagnosticoController@store');
    Route::put('/Diagnostico/editar','DiagnosticoController@edit');
    Route::post('/Diagnostico/delete', 'DiagnosticoController@drop');


    //Rutas para Excel
    Route::get('/Excel/Alumno','ExcelController@alumno');
    Route::get('/Excel/Cumple','ExcelController@cumple');
    Route::get('/Excel/Gasto','ExcelController@gasto');
    Route::get('/Excel/Altura','ExcelController@altura');
    Route::get('/Excel/Historial','ExcelController@historial');
    Route::get('/Excel/Peso','ExcelController@peso');

    Route::get('/Donacion','DonacionController@index');
});
//Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
