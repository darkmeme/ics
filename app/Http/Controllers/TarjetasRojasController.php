<?php

namespace App\Http\Controllers;

use App\TarjetasRojas;
use Illuminate\Http\Request;
use App\User;
use App\EquiposModel;
use App\PlantasModel;
use Illuminate\Support\Facades\Redirect;
Use Session;
use Auth;
use Illuminate\Support\Facades\Mail;
use \App\Mail\AsignarTarjetaRoja;
use Brian2694\Toastr\Facades\Toastr;

class TarjetasRojasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $totalTarjetas=TarjetasRojas::count();
        $totalEmitidas=TarjetasRojas::where(['status' => 'Asignada'])->count();
        $totalReasignadas=TarjetasRojas::where(['status' => 'Reasignada'])->count();
        $totalFinalizadas=TarjetasRojas::where(['status' => 'Finalizada'])->count();
        $plantas=PlantasModel::ALL();
        $pendientes=$totalTarjetas-$totalFinalizadas;

        $filtro=trim($request->get('buscar'));
        $tarjetasRojas=TarjetasRojas::where('status','LIKE','%'.$filtro.'%')->get();

        //seccion para cargar todas la tarjetas rojas creadas por un usuario
        $user_actual=Auth::user()->id;
        $tarjetas=TarjetasRojas::where('user_id',$user_actual)->get();

        //seccion para cargar tarjetas asignadas y reasignadas
        $tarjetasAsig=TarjetasRojas::where('user_asignado', $user_actual)
        ->orWhereIn('user_reasignado', [$user_actual])
        ->get();

        return view('tarjetas-rojas.index',compact('tarjetasRojas','tarjetasAsig','filtro','plantas','tarjetas', 'totalTarjetas', 'totalEmitidas', 'totalReasignadas', 'totalFinalizadas', 'pendientes'));
    }

    /*     **Funciones no necesarias ya, ahora todo se manda al index**!

    //funcion que carga todas la tarjetas rojas creadas por un usuario
    public function misTarjetasRojas(){
       /* $user_actual=Auth::user()->id;
        $tarjetas=TarjetasRojas::where('user_id',$user_actual)->get();
        $plantas=PlantasModel::ALL();
        return view('tarjetas-rojas.tarjetas-creadas',compact('tarjetas', 'plantas'));
        
    }

    public function tarjetasRojasAsignadas(Request $request){
       /* $user_actual=Auth::user()->id;
        $tarjetas=TarjetasRojas::where('user_asignado', $user_actual)
        ->orWhereIn('user_reasignado', [$user_actual])
        ->get();
        
        //->orWhereIn('user_reasignado', $user_actual)
        
        $plantas=PlantasModel::ALL();
        //dd($tarjetas);
        return view('tarjetas-rojas.tarjetas-rojas-asignadas',compact('tarjetas', 'plantas'));
        
    }


    public function create()
    {
      /*  $users=User::All();
        $plantas=PlantasModel::All();
        
        return view('tarjetas-rojas.create',compact('users','plantas'));

    }
    */

    public function asignar(Request $request,$id)
    {
  $tarjeta=TarjetasRojas::findOrFail($id);
  //si una tarjeta ya fue finalizada no se puede volver a reasignar
     if ($tarjeta->finalizado==1){
    Toastr::error('La tarjeta no se puede asignar porque ya esta finalizada' ,'Asignacion');
      return back();
    }
      else{
  //$user=User::where('id',$id)->get(['name']);
  $tarjeta->user_reasignado=$request->get('empleado_id');
  $tarjeta->status='Reasignada';
  $tarjeta->motivo_reasignado=$request->get('motivo');
  $tarjeta->update();
  //dd('llego el request'.' id tarjeta '. $id . ' id user '.$tarjeta->user_reasignado);
  $correo=$tarjeta->reasignado->email;
  $nombre=$tarjeta->reasignado->name;
  
  Mail::to($correo,$nombre)
  ->send(new AsignarTarjetaRoja($tarjeta));
  Toastr::info('Tarjeta Reasignada Correctamente, se envio un correo a: '.$nombre ,'Asignacion');
  return back();
  }
}


public function cambiarResponsable(Request $request,$id)
{
  $tarjeta=TarjetasRojas::findOrFail($id);
  //si una tarjeta ya fue finalizada no puede cambiar de responsable
  if ($tarjeta->finalizado==1){
    Toastr::error('No se puede Cambiar de responsable porque la tarjeta ya esta finalizada' ,'Cambio Responsable');
    return back();
  }
  else{
  //$user=User::where('id',$id)->get(['name']);
  $tarjeta->user_asignado=$request->get('empleado_id');
  //$tarjeta->status='Reasignada';
  //$tarjeta->motivo_reasignado=$request->get('motivo');
  $tarjeta->update();
  //dd('llego el request'.' id tarjeta '. $id . ' id user '.$tarjeta->user_reasignado);
  $correo=$tarjeta->asignado->email;
  $nombre=$tarjeta->asignado->name;
  
  Mail::to($correo,$nombre)
  ->send(new AsignarTarjetaRoja($tarjeta));
  Toastr::info('Responsable Cambiado Correctamente, se envio un correo a: '.$nombre ,'Cambio Responsable');
  return back();
  }
}


public function finalizar(Request $request,$id)
{
  $tarjeta=TarjetasRojas::findOrFail($id);
  if ($tarjeta->finalizado==1){
    Toastr::error('No es posible finalizar, esta tarjeta ya fue finalizada' ,'Finalizar');
    return back();
    }
    else{
  $tarjeta->user_finaliza=$request->get('user_finaliza');
  $tarjeta->solucion_implementada=$request->get('solucion');
  $tarjeta->status='Finalizada';
  $tarjeta->finalizado=1;
  $tarjeta->fecha_cierre= new \DateTime();
  $tarjeta->update();
  Toastr::success('Tarjeta Finalizada Satisfactoriamente' ,'Finalizar');
  return back();
}
}


    public function store(Request $request)
    {

      $tarjetaR=new TarjetasRojas;
      $tarjetaR->user_id=$request->get('empleado_id');
      $tarjetaR->area_id=$request->get('area_id');
      $tarjetaR->equipo_id=$request->get('equipo_id');
      $tarjetaR->prioridad=$request->get('prioridad');
      $tarjetaR->descripcion_reporte=$request->get('descripcion_reporte');
      $tarjetaR->planta_id=$request->get('planta_id');
      $tarjetaR->turno=$request->get('turno');   
          
      //se asigna automaticamente la tarjeta Roja     
      $tarjetaR->user_asignado=(4);
      $tarjetaR->status='Asignada';
    
      $tarjetaR->save();
      //se envia correo al usuario que se le asigno la tarjeta
      $correo=$tarjetaR->asignado->email;
      $nombre=$tarjetaR->asignado->name;
     // Mail::to($correo,$nombre)
      //->send(new AsignarTarjetaRoja($tarjetaR));

     //se guarda la imagen de la tarjeta
      /*$foto = $request->file('foto');
      $ext = $foto->getClientOriginalExtension();
      $rutaImg = 'img/'.$tarjetas->id. '.' .$ext;
      
      Image::make($foto)->orientate()->save($rutaImg, 50);
      //->widen(500)
     

      $tarjetas->ruta_foto = $ext;
      $tarjetas->save();*/

     //se envia notificacion a la vista por medio de Toastr.
     Toastr::success('Tarjeta Creada Satisfactoriamente :)' ,'Success');
      return Redirect::to('tarjetas-rojas');

    }


    public function show(Request $request, $id)
    {
        
        //variable empleados para llenar combo de empleados en el modal de reasignar
        $user=User::get(['id','name']);//selecciona solo dos campos de la tabla
        $tarjetaR=TarjetasRojas::findOrFail($id);
        if ($request->ajax()){
        
          return response()->json([
            'data'=>$tarjetaR]);
          }
        return view('tarjetas-rojas.show', compact('user','tarjetaR'));

    }


    public function edit(TarjetaRoja $tarjetaRoja)
    {
        //
    }


    public function update(Request $request, $id)
    {
      $tarjeta=TarjetasRojas::findOrFail($id);
      $tarjeta->prioridad=$request->get('prioridad');
      $tarjeta->descripcion_reporte=$request->get('descripcion');
      $tarjeta->update();
      //Toastr::success('Tarjeta Editada Satisfactoriamente' ,'Edicion');
      //Session::flash('message','Tarjeta actualizada correctamente');
      //return Redirect::to('tarjetas-asignadas');
      return response()->json($tarjeta);
    }


    public function destroy($id)
    {
      $tarjeta=TarjetasRojas::findOrFail($id);
      $tarjeta->Delete();
     // Toastr::success('Tarjeta Eliminada Satisfactoriamente' ,'Borrar');
      return response()->json($tarjeta);
    }
}
