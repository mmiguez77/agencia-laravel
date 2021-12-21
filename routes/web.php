<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/saludo', function () {
    return 'Hola Mundo';
});

Route::get('/test', function () {
    return view('prueba');
});

Route::get('/imprimir', function () {
    $nombre = 'Lalo';
    $marcas = ['Ford','Chevrolet','Audi'];

    return view('imprimir', 
        [  
            'nombre'=>$nombre, 
            'marcas'=>$marcas,
        ]
    );
});

// Vista Inicio
Route::get('/inicio', function () {
    return view('inicio');
});

// CRUD adminRegiones

Route::get('/adminRegiones', function () {

    // Obtenemos listado de Regiones
    $regiones = DB::select('SELECT idRegion, regNombre FROM regiones');
    // Retornar vista de admin
    return view('adminRegiones', 
        [ 
            'regiones'=>$regiones
        ]
    );
});

Route::get('/agregarRegion', function () {
    return view('agregarRegion');
});

Route::post('/agregarRegion', function () {

    // Datos del form
    $regNombre = $_POST['regNombre'];
    // Insertamos datos en tabla de regiones
    DB::insert("INSERT INTO regiones
                        ( regNombre )
                    VALUE
                        ( :regNombre )",
                [ $regNombre ] );
    // Reporte
    return redirect('/adminRegiones')
                ->with(['mensaje' => 'Region: '.$regNombre.' agregada correctamente.']);

});