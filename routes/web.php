<?php
use Illuminate\Support\Facades\Mail;

// rutas de tipo resource usados para manejar los crud de todas las tablas
Route::resource('equipos', 'EquiposController');
Route::resource('categorias', 'CategoriasController');
Route::resource('medidores', 'MedidoresController');
//Route::group(['middleware' => ['role:Administrador']], function () {});
Route::resource('areas', 'AreasController');
//Route::get('/tarjetas/{filtro}','TarjetasController@index');
Route::resource('users', 'UsersController');
Route::resource('roles', 'RolesController');
Route::resource('eventos', 'EventosController');
Route::resource('causas', 'CausasController');
Route::resource('plantas', 'PlantasController');
Route::resource('prioridades', 'PrioridadesController');
Route::resource('status', 'StatusController');
Route::resource('tarjetas', 'TarjetasController');
Route::resource('tarjetas-rojas', 'TarjetasRojasController');
Route::resource('puestos', 'PuestosController');
Route::resource('ordenes', 'OrdenesController');
//ruta para asignar una tarjeta a un empleado
Route::post('/asignar/{idtarjeta}','TarjetasController@asignar');
//ruta para finalizar una TarjetasModel
Route::post('/finalizar/{idtarjeta}','TarjetasController@finalizar');
//ruta para las autentificaciones
Auth::routes();


//ruta paara petecion de usuario por medio de json
Route::get('list-users/{filtro}', 'UsersController@users_json');


//Route::get('/', 'TarjetasController@mis_tarjetas');

//rutas para los permisos
Route::post('/permisos', 'RolesController@create_permission');
Route::delete('/permisos-borrar/{id}/', 'RolesController@delete_permission');
Route::post('/permisos-asignar/{id}/{permiso}/', 'RolesController@asignar_permiso');
Route::get('/roles-asignar', 'RolesController@asignar_rol');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/reportes/{id}/','TarjetasController@pdf');
//Route::get('reporte', 'RolesController@pdf');//->name('roles.pdf');
//ruta para las peticiones ajax
Route::get('/planta/{id}/areas','AreasController@areas_plantas');
Route::get('/area/{id}/equipos','EquiposController@equipos_areas');
Route::get('/area/{id}/equiposPadres','EquiposController@equipos_padres');
// rutas para cargar las tarjetas creadas y asignadas a un usuario
Route::get('/mis-tarjetas', 'TarjetasController@mis_tarjetas');
Route::get('/tarjetas-asignadas', 'TarjetasController@tarjetas_asignadas');




Route::get('pruebaLecturas', function () {
    $medidor=App\Medidores::findOrfail(1);
    $user=\Illuminate\Support\Facades\Auth::user()->name;

    Mail::to('geovany.hernandez90@gmail.com','Elmer Hernandez')
        ->send(new \App\Mail\LecturasEnergia($medidor,$user));
});