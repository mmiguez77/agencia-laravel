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