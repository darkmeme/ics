<?php

namespace App\Http\Controllers;

use App\TarjetasRojas;
use Illuminate\Http\Request;
use App\User;
use App\EquiposModel;
use App\PlantasModel;
use App\EventosModel;
use App\CategoriasModel;
use App\CausasModel;
use Illuminate\Support\Facades\Redirect;
Use Session;
use Auth;
use Illuminate\Support\Facades\Mail;
use \App\Mail\AsignarTarjeta;

class TarjetasRojasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $filtro=trim($request->get('buscar'));

        $tarjetasRojas=TarjetasRojas::where('status','LIKE','%'.$filtro.'%')->get();
        return view('tarjetas.rojas.index',compact('tarjetasRojas','filtro'));
    }

    //funcion que carga todas la tarjetas rojas creadas por un usuario
    public function misTarjetasRojas(){
        $user_actual=Auth::user()->id;
        $tarjetas=TarjetasRojas::where('user_id',$user_actual)->get();
        return view('tarjetas.rojas.misTarjetasRojas',compact('tarjetas'));
    }

    public function tarjetasRojasAsignadas(Request $request){
        $user_actual=Auth::user()->id;
        $tarjetas=TarjetasRojas::where('user_asignado',$user_actual)->get();
        //dd($tarjetas);
        return view('tarjetas.rojas.tarjetasRojasAsignadas',compact('tarjetas'));
    }


    public function create()
    {
        $users=User::All();
        $equipos=EquiposModel::All();
        $plantas=PlantasModel::ALL();
        return view('tarjetas.rojas.create',compact('users','equipos','plantas'));

    }


    public function store(Request $request)
    {

    }


    public function show(TarjetaRoja $tarjetaRoja)
    {
        //
    }


    public function edit(TarjetaRoja $tarjetaRoja)
    {
        //
    }


    public function update(Request $request, TarjetaRoja $tarjetaRoja)
    {
        //
    }


    public function destroy(TarjetaRoja $tarjetaRoja)
    {
        //
    }
}
