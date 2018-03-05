<?php

namespace App\Http\Controllers;

use App\TarjetasModel;
use App\AreasModel;
use App\User;
use App\EquiposModel;
use App\PlantasModel;
use App\EventosModel;
use App\CategoriasModel;
use App\CausasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
Use Session;
use Auth;


class TarjetasController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }


    public function index(Request $request)
    {
      $tarjetas=TarjetasModel::All();
      return view('tarjetas.index',compact('tarjetas'));
    }

//funcion que carga todas la tarjetas creadas por un usuario
public function mis_tarjetas(Request $request){
  $user_actual=Auth::user()->id;
   $tarjetas=TarjetasModel::where('user_id',$user_actual)->get();
   //dd($tarjetas);
   return view('tarjetas.mis-tarjetas',compact('tarjetas'));
}

public function tarjetas_asignadas(Request $request){
  $user_actual=Auth::user()->id;
   $tarjetas=TarjetasModel::where('user_asignado',$user_actual)->get();
   //dd($tarjetas);
   return view('tarjetas.tarjetas-asignadas',compact('tarjetas'));
}



    public function create()
    {
      $users=User::All();
      $equipos=EquiposModel::All();
      $plantas=PlantasModel::ALL();
      $eventos=EventosModel::ALL();
      $categorias=CategoriasModel::ALL();
      $causas=CausasModel::ALL();
      return view('tarjetas.create',compact('users','users','equipos','plantas','eventos','categorias','causas'));

    }

    public function store(Request $request)
    {
      $tarjetas=new TarjetasModel;
      $tarjetas->user_id=$request->get('empleado_id');
      $tarjetas->area_id=$request->get('area_id');
      $tarjetas->equipo_id=$request->get('equipo_id');
      $tarjetas->prioridad=$request->get('prioridad');
      $tarjetas->descripcion_reporte=$request->get('descripcion_reporte');
      $tarjetas->planta_id=$request->get('planta_id');
      $tarjetas->categoria_id=$request->get('categoria_id');
      $tarjetas->solucion_implementada=$request->get('solucion_implementada');
      $tarjetas->evento_id=$request->get('evento_id');
      $tarjetas->turno=$request->get('turno');
      $tarjetas->causa_id=$request->get('causa_id');
      $tarjetas->status='enviada';
      $tarjetas->user_asignado=(1);
      $tarjetas->user_finaliza=(1);

      //$tarjetas->fecha_cierre=$request->get('fecha_cierre');
      //$tarjetas->finalizado=$request->get('cerrado');

      $tarjetas->save();
      return Redirect::to('tarjetas');
    }

    public function show($id)
    {
      //variable empleados para llenar combo de empleados en el modal de reasignar
        $user=User::get(['id','name']);//selecciona solo dos campos de la tabla
        //dd($empleados);
        $tarjetas=TarjetasModel::findOrFail($id);
        //$asignado=TarjetasModel::with('asignado')->get();
        //dd($asignado);
        return view('tarjetas.show', compact('user','tarjetas'));

    }



    public function edit($id)
    {
    return view('tarjetas.edit',["tarjetas"=>TarjetasModel::findOrFail($id)]);
    }


// fucnion para reasignar una tarjetas, esta info se carga desde modal de show
public function asignar(Request $request,$id)
{
  $tarjeta=TarjetasModel::findOrFail($id);
  $tarjeta->user_asignado=$request->get('empleado_id');
  $tarjeta->status='Asignada';
  $tarjeta->update();
  return Redirect::to('tarjetas');
}


public function finalizar(Request $request,$id)
{
  $tarjeta=TarjetasModel::findOrFail($id);
  if ($tarjeta->finalizado==1){
    Session::flash('message','Esta tarjeta ya fue finalizada');
    return Redirect::to('tarjetas');
    }
    else{
  $tarjeta->user_finaliza=$request->get('user_finaliza');
  $tarjeta->solucion_implementada=$request->get('solucion');
  $tarjeta->status='Finalizada';
  $tarjeta->finalizado=1;
  $tarjeta->fecha_cierre= new \DateTime();
  $tarjeta->update();
  return Redirect::to('tarjetas');
}
}


    public function update(Request $request, $id)
    {
      $tarjetas=  TarejetasModel::findOrFail($id);
      $tarjetas->fehca=$request->get('fehca');
      $tarjetas->user_id=$request->get('empleado_id');
      $tarjetas->area_id=$request->get('area_id');
      $tarjetas->equipo_id=$request->get('equipo_id');
      $tarjetas->prioridad=$request->get('prioridad');
      $tarjetas->descripcion_reporte=$request->get('descripcion_reporte');
      $tarjetas->planta_id=$request->get('planta_id');
      $tarjetas->categoria=$request->get('categoria');
      $tarjetas->solucion_implementada=$request->get('solucion_implementada');
      $tarjetas->evento=$request->get('evento_id');
      $tarjetas->turno=$request->get('turno');
      $tarjetas->causa=$request->get('causa');
      $tarjetas->fecha_cierre=$request->get('fecha_cierre');
      $tarjetas->cierre=$request->get('cierre');
      $tarjetas->update();
      return Redirect::to('tarjetas');
    }

    public function destroy($id)
    {
      $tarjetas=TarjetasModel::findOrFail($id);
      $tarjetas->Delete();
      //Post::destroy($id);
      Return Redirect::to('tarjetas');
    }//generador de crud


    public function pdf($id)
      {
          $tarjetas = TarjetasModel::where('planta_id',$id)->get();
          //$date = date('Y-m-d');
          $view =  \View::make('tarjetas.pdf', compact('tarjetas'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          return $pdf->stream('ReporteTarjetas');
      }
}
