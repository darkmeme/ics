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
use Illuminate\Support\Facades\Mail;
use \App\Mail\AsignarTarjeta;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\TarjetasRequest;
use Illuminate\Support\Carbon;
use Image;


class TarjetasController extends Controller
{

 public function __construct()
 {
    $this->middleware('auth');
  }


    public function index(Request $request)
    {
      $totalTarjetas=TarjetasModel::count();
      //$totalEmitidas=TarjetasModel::where(['status' => 'Asignada'])->count();
      //$totalReasignadas=TarjetasModel::where(['status' => 'Reasignada'])->count();
      $totalFinalizadas=TarjetasModel::where(['status' => 'Finalizada'])->count();
      $pendientes=$totalTarjetas-$totalFinalizadas;
      //filtro por rango de fechas
      $inicio=$request->get('inicio');
      $fin=$request->get('fin');
      $status=$request->get('status');
      $filtro=$request->get('fecha');

     // dd($fin);
      $tar = TarjetasModel::query();
      if(($inicio != '') and ($fin != '')){ 
             
        if($filtro == 'crea'){
          $tar->whereBetween('created_at', [$inicio, $fin])->get();
        }else{
          $tar->whereBetween('fecha_cierre', [$inicio, $fin])->get();
        }
            
      }  else{
        $filtro = 'crea';
      }
      //filtro de tarjetas por status  
      if($status == null || $status == 'def'){

          }
      else{
        $tar->where('status', $status);
      }     

       $tarjetas = $tar->get();          
     
      //datos para crear tarjeta con modal
      $plantas=PlantasModel::ALL();
      $eventos=EventosModel::ALL();
      $categorias=CategoriasModel::ALL();
      $causas=CausasModel::ALL();

      //funcion que carga todas la tarjetas creadas por un usuario
      $user_actual=Auth::user()->id;
      $tarjetasC=TarjetasModel::where('user_id',$user_actual)->get();
      //funcion para cargar todas las tarjetas asignadas a un usuario
      $tarjetasAsig=TarjetasModel::where('user_asignado', $user_actual)
        ->orWhereIn('user_reasignado', [$user_actual])
        ->get();

     return view('tarjetas.index',compact('tarjetas','tarjetasC','tarjetasAsig',
     'status', 'totalTarjetas','plantas','eventos','categorias',
     'causas', 'totalFinalizadas', 'pendientes', 'inicio', 'fin', 'filtro'));  
    }

/*    **Funciones no necesarias ya, ahora todo se manda al index**!

//funcion que carga todas la tarjetas creadas por un usuario
public function mis_tarjetas(Request $request){
  /*$user_actual=Auth::user()->id;
   $tarjetas=TarjetasModel::where('user_id',$user_actual)->get();
   return view('tarjetas.mis-tarjetas',compact('tarjetas'));
}

//funcion para cargar todas las tarjetas asignadas a un usuario
public function tarjetas_asignadas(Request $request){
  $user_actual=Auth::user()->id;
   $tarjetas=TarjetasModel::where('user_asignado',$user_actual)->get();
   return view('tarjetas.tarjetas-asignadas',compact('tarjetas'));
}


//funcion para llamar la vista de crear tarjeta, se mandan variables para llenar los select
    public function create()
    {
      $users=User::All();
    
     // $equipos=EquiposModel::All(); no es necesario porque se obtienen estos datos por ajax  
      $plantas=PlantasModel::ALL();
      $eventos=EventosModel::ALL();
      $categorias=CategoriasModel::ALL();
      $causas=CausasModel::ALL();
      return view('tarjetas.create',compact('users','plantas','eventos','categorias','causas'));
    }
*/
    //funcion para almacenar una nueva tarjeta en la db
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
    //  $tarjetas->solucion_implementada=$request->get('solucion_implementada');
      $tarjetas->evento_id=$request->get('evento_id');
      $tarjetas->turno=$request->get('turno');
      $tarjetas->causa_id=$request->get('causa_id');
// si la tajeta es electrica o mencanica se se asigna al planificador de mantenimiento
      if ($tarjetas->categoria->nombre=='Electrica' or $tarjetas->categoria->nombre=='Mecanica'){
      $tarjetas->user_asignado=(353); //asignar a 353 -> Rivera
      $tarjetas->status='Pendiente';
    }
// si no la tarjeta se asigna al encargado de she
    else {
      $tarjetas->user_asignado=(359);
      $tarjetas->status='Pendiente';
    }
      $tarjetas->save();
      //se envia correo al usuario que se le asigno la tarjeta
      $correo=$tarjetas->asignado->email;
      $nombre=$tarjetas->asignado->name;
      Mail::to($correo,$nombre)
      ->send(new AsignarTarjeta($tarjetas));

     /*se guarda la imagen de la tarjeta
      $foto = $request->file('foto');
      $ext = $foto->getClientOriginalExtension();
      $rutaImg = 'img/'.$tarjetas->id. '.' .$ext;
      
      Image::make($foto)->orientate()->save($rutaImg, 50);
      
      $tarjetas->ruta_foto = $ext;
      $tarjetas->save();*/

     //se envia notificacion a la vista por medio de Toastr.
     Toastr::success('Tarjeta Creada Satisfactoriamente :)' ,'Success');
      return Redirect::to('tarjetas');
    }


    public function show(Request $request,$id)
    {  
      
      //variable empleados para llenar combo de empleados en el modal de reasignar
        $user=User::get(['id','name']);//selecciona solo dos campos de la tabla
        $tarjetas=TarjetasModel::findOrFail($id);
        if ($request->ajax()){
        
          return response()->json([
            'data'=>$tarjetas]);
          }
        return view('tarjetas.show', compact('user','tarjetas'));
    }


// funcion para editar algunos datos de la tarjeta, se envian los datos a la vista en formato json
    public function edit($id)
    {
   $tarjeta=TarjetasModel::findOrFail($id);
   return response()->json([
       'status' => 'success',
       'descripcion' => $tarjeta->descripcion_reporte,
       'prioridad' => $tarjeta->prioridad,
       'equipo' =>$tarjeta->equipo->nombre,
   ]);
    }


// funcion para reasignar una tarjetas, esta info se carga desde modal de show
public function asignar(TarjetasRequest $request,$id)
{
  $tarjeta=TarjetasModel::findOrFail($id);
  //si una tarjeta ya fue finalizada no se puede volver a reasignar
  if ($tarjeta->finalizado==1){
    Toastr::error('La tarjeta no se puede asignar porque ya esta finalizada' ,'Asignacion');
    return back();
  }
  else{
  //$user=User::where('id',$id)->get(['name']);
  $tarjeta->user_reasignado=$request->get('empleado_id');
  //$tarjeta->status='Pendiente';
  $tarjeta->motivo_reasignado=$request->get('motivo');
  $tarjeta->update();
  //dd('llego el request'.' id tarjeta '. $id . ' id user '.$tarjeta->user_reasignado);
  $correo=$tarjeta->reasignado->email;
  $nombre=$tarjeta->reasignado->name;
  
  Mail::to($correo,$nombre)
  ->send(new AsignarTarjeta($tarjeta));
  Toastr::info('Tarjeta Reasignada Correctamente, se envio un correo a: '.$nombre ,'Asignacion');
  return back();
  }
}


public function cambiarResponsable(TarjetasRequest $request,$id)
{
  $tarjeta=TarjetasModel::findOrFail($id);
  //si una tarjeta ya fue finalizada no puede cambiar de responsable
  if ($tarjeta->finalizado==1){
    Toastr::error('No se puede Cambiar de responsable porque ya esta finalizada' ,'Cambio Responsable');
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
  ->send(new AsignarTarjeta($tarjeta));
  Toastr::info('Responsable Cambiado Correctamente, se envio un correo a: '.$nombre ,'Cambio Responsable');
  return back();
  }
}

public function finalizar(Request $request,$id)
{
  $tarjeta=TarjetasModel::findOrFail($id);
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


    public function update(Request $request, $id)
    {
      $tarjetas=TarjetasModel::findOrFail($id);
      $tarjetas->prioridad=$request->get('prioridad');
      $tarjetas->descripcion_reporte=$request->get('descripcion');
      $tarjetas->update();
      //Toastr::success('Tarjeta Editada Satisfactoriamente' ,'Edicion');
      //Session::flash('message','Tarjeta actualizada correctamente');
      //return Redirect::to('tarjetas-asignadas');
      return response()->json($tarjetas);
    }

    //funcion para eliminar una tarjeta, recibe como parametro el id de la tarjeta
    public function destroy($id)
    {
      $tarjetas=TarjetasModel::findOrFail($id);
      $tarjetas->Delete();
     // Toastr::success('Tarjeta Eliminada Satisfactoriamente' ,'Borrar');
      return response()->json($tarjetas);
    }

// prueba de generar un reporte pdf utilizando el plugin dompdf
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
