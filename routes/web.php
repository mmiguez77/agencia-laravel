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

Route::get('/modificarRegion/{id}', function ($idRegion)
{
    //obtenemos datos de la región
    /*$region = DB::select('
                SELECT * FROM
                    regiones
                    WHERE idRegion = :id', [$idRegion] );*/
    $region = DB::table('regiones')
                    ->where('idRegion', $idRegion)
                    ->first();  // fetch()

    return view('modificarRegion',
                [ 'region'=>$region ]
            );
});

Route::post('/modificarRegion', function ()
{
    $regNombre = $_POST['regNombre'];
    $idRegion = $_POST['idRegion'];
    /*DB::update('UPDATE regiones
                    SET regNombre = :regNombre
                  WHERE idRegion  = :idRegion',
                    [ $regNombre, $idRegion ]);*/
    DB::table('regiones')
            ->where( 'idRegion', $idRegion )
            ->update( [ 'regNombre' => $regNombre ] );
    //redirección con reporte ok
    return redirect('/adminRegiones')
        ->with(['mensaje'=>'Region: '.$regNombre.' agregada correctamente.']);
});


// DESTINOS

Route::get('/adminDestinos', function () {

    /*$destinos = DB::select('
        SELECT
        idDestino, destNombre, destPrecio,
        regNombre
        FROM destinos as d
        JOIN regiones as r
        ON d.idRegion = r.idRegion
        ');*/
    $destinos = DB::table('destinos as d')
        ->select('idDestino', 'destNombre', 'destPrecio','regNombre')
        ->join('regiones as r', 'd.idRegion', '=', 'r.idRegion' )
        ->get(); 

    return view('adminDestinos', [ 'destinos' => $destinos ]);
});

Route::get('/agregarDestino', function () {

    //obtenemos listado de regiones
    $regiones = DB::table('regiones')->get();

    return view('agregarDestino', [ 'regiones' => $regiones ]);
});

Route::post('/agregarDestino', function () {
    //capturamos datos enviados por el form
    $destNombre = $_POST['destNombre'];
    $idRegion = $_POST['idRegion'];
    $destPrecio = $_POST['destPrecio'];
    $destAsientos = $_POST['destAsientos'];
    $destDisponibles = $_POST['destDisponibles']; 

    // Insertamos en la DB
    DB::table('destinos')
        ->insert(
            [
                'destNombre'=>$destNombre,
                'idRegion'=>$idRegion, 
                'destPrecio'=>$destPrecio,
                'destAsientos'=>$destAsientos,
                'destDisponibles'=>$destDisponibles
            ]
        );

        //redirigimos con mensaje de ok
    return redirect('/adminDestinos')
        ->with(['mensaje' => 'Destino ' . $destNombre . ' agregado correctamente']);
    
});

Route::get('/modificarDestino/{id}', function ($idDestino) {

    $destino = DB::table('destinos') 
            ->where('idDestino', $idDestino)
            ->first(); 
        
    return view('modificarDestino', [ 'destino' => $destino]); 
});