<?php

use Illuminate\Http\Request;

//Route::middleware('auth:api')->get('/user', function (Request $request) {
  //  return $request->user();
//});

Route::get('/planta/{id}/areas','AreasController@areas_plantas');
Route::get('/area/{id}/equipos','EquiposController@equipos_areas');



//ruta para solicitar listado de usuarios del sistema
Route::get('/list-users/{filter}','UsersController@users_json');

