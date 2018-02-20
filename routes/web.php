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

//Route::get('/', function () {
  // return view('layouts.admin');
//});
// rutas de tipo resource usados para manejar los crud de todas las tablas
Route::resource('equipos', 'EquiposController');
Route::resource('categorias', 'CategoriasController');

Route::group(['middleware' => ['role:super-admin|Administrador']], function () {

});


//Route::resource('empleados', 'EmpleadosController');
Route::resource('roles', 'RolesController');
Route::resource('areas', 'AreasController');
Route::resource('eventos', 'EventosController');
Route::resource('causas', 'CausasController');
Route::resource('plantas', 'PlantasController');
Route::resource('prioridades', 'PrioridadesController');
Route::resource('status', 'StatusController');
Route::resource('tarjetas', 'TarjetasController');
Route::resource('puestos', 'PuestosController');
Route::resource('ordenes', 'OrdenesController');
//ruta para asignar una tarjeta a un empleado
Route::post('/asignar/{idtarjeta}','TarjetasController@asignar');
//ruta para las autentificaciones
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/reportes/{id}/','TarjetasController@pdf');
//Route::get('reporte', 'RolesController@pdf');//->name('roles.pdf');
//ruta para las peticiones ajax
Route::get('/planta/{id}/areas','AreasController@areas_plantas');
Route::get('/area/{id}/equipos','EquiposController@equipos_areas');
