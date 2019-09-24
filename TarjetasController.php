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
      $prioridad=$request->get('prioridad');
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
       

       //------------filtro por prioridad------------------ 
       if($prioridad == null || $prioridad == 'def'){
      }
       else{
        $tar->where('prioridad', $prioridad);
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
     'causas', 'totalFinalizadas', 'pendientes', 'inicio', 'fin', 'filtro','prioridad'));  
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

    public function chart()
      {      

        //variables para recoger el numero de tarjetas finalizadas en cada planta
        $num_nsd = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '2'])->count();
        $num_combi = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '1'])->count();
        $num_sulfonacion = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '3'])->count();
        $num_calderas = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '4'])->count();
        $num_oficinasadmin = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '7'])->count();
        $num_blanqueo = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '6'])->count();

        //variables para recoger el numero de tarjetas pendientes en cada planta
        $pen_nsd = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '2'])->count();
        $pen_combi = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '1'])->count();
        $pen_sulfonacion = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '3'])->count();
        $pen_calderas = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '4'])->count();
        $pen_oficinasadmin = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '7'])->count();
        $pen_blanqueo = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '6'])->count();
        
        //variables para recoger el numero de tarjetas por prioridad las áreas
        $combi_prioA_final = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '1'])->where(['prioridad' => 'A'])->count();
        $combi_prioB_final = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '1'])->where(['prioridad' => 'B'])->count();
        $combi_prioC_final = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '1'])->where(['prioridad' => 'C'])->count();

        $combi_prioA_pen = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '1'])->where(['prioridad' => 'A'])->count();
        $combi_prioB_pen = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '1'])->where(['prioridad' => 'B'])->count();
        $combi_prioC_pen = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '1'])->where(['prioridad' => 'C'])->count();


        $nsd_prioA_final = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '2'])->where(['prioridad' => 'A'])->count();
        $nsd_prioB_final = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '2'])->where(['prioridad' => 'B'])->count();
        $nsd_prioC_final = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '2'])->where(['prioridad' => 'C'])->count();

        $nsd_prioA_pen = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '2'])->where(['prioridad' => 'A'])->count();
        $nsd_prioB_pen = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '2'])->where(['prioridad' => 'B'])->count();
        $nsd_prioC_pen = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '2'])->where(['prioridad' => 'C'])->count();

        $sulfonacion_prioA_final = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '3'])->where(['prioridad' => 'A'])->count();
        $sulfonacion_prioB_final = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '3'])->where(['prioridad' => 'B'])->count();
        $sulfonacion_prioC_final = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '3'])->where(['prioridad' => 'C'])->count();

        $sulfonacion_prioA_pen = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '3'])->where(['prioridad' => 'A'])->count();
        $sulfonacion_prioB_pen = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '3'])->where(['prioridad' => 'B'])->count();
        $sulfonacion_prioC_pen = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '3'])->where(['prioridad' => 'C'])->count();

        $calderas_prioA_final = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '4'])->where(['prioridad' => 'A'])->count();
        $calderas_prioB_final = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '4'])->where(['prioridad' => 'B'])->count();
        $calderas_prioC_final = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '4'])->where(['prioridad' => 'C'])->count();

        $calderas_prioA_pen = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '4'])->where(['prioridad' => 'A'])->count();
        $calderas_prioB_pen = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '4'])->where(['prioridad' => 'B'])->count();
        $calderas_prioC_pen = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '4'])->where(['prioridad' => 'C'])->count();

        $oficinasadmin_prioA_final = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '7'])->where(['prioridad' => 'A'])->count();
        $oficinasadmin_prioB_final = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '7'])->where(['prioridad' => 'B'])->count();
        $oficinasadmin_prioC_final = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '7'])->where(['prioridad' => 'C'])->count();

        $oficinasadmin_prioA_pen = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '7'])->where(['prioridad' => 'A'])->count();
        $oficinasadmin_prioB_pen = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '7'])->where(['prioridad' => 'B'])->count();
        $oficinasadmin_prioC_pen = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '7'])->where(['prioridad' => 'C'])->count();

        $blanqueo_prioA_final = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '6'])->where(['prioridad' => 'A'])->count();
        $blanqueo_prioB_final = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '6'])->where(['prioridad' => 'B'])->count();
        $blanqueo_prioC_final = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '6'])->where(['prioridad' => 'C'])->count();

        $blanqueo_prioA_pen = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '6'])->where(['prioridad' => 'A'])->count();
        $blanqueo_prioB_pen = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '6'])->where(['prioridad' => 'B'])->count();
        $blanqueo_prioC_pen = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '6'])->where(['prioridad' => 'C'])->count();

     //   $plantaArray = array($num_nsd,
     //                        $num_combi,
     //                        $num_empaque);
          
        //return response()->json($plantaArray);
       // dd($combi_prio_final);
       
       return view('graficas', compact(
        'num_nsd','num_combi','num_sulfonacion','num_calderas','num_oficinasadmin','num_blanqueo',
        'pen_nsd','pen_combi','pen_sulfonacion','pen_calderas','pen_oficinasadmin','pen_blanqueo',
        
        'combi_prioA_final','combi_prioB_final','combi_prioC_final','combi_prioA_pen',
        'combi_prioB_pen','combi_prioC_pen',

        'nsd_prioA_final','nsd_prioB_final','nsd_prioC_final',
        'nsd_prioA_pen', 'nsd_prioB_pen','nsd_prioC_pen',

        'sulfonacion_prioA_final','sulfonacion_prioB_final','sulfonacion_prioC_final',
        'sulfonacion_prioA_pen', 'sulfonacion_prioB_pen','sulfonacion_prioC_pen',

        'calderas_prioA_final','calderas_prioB_final','calderas_prioC_final',
        'calderas_prioA_pen', 'calderas_prioB_pen','calderas_prioC_pen',

        'oficinasadmin_prioA_final','oficinasadmin_prioB_final','oficinasadmin_prioC_final',
        'oficinasadmin_prioA_pen', 'oficinasadmin_prioB_pen','oficinasadmin_prioC_pen',

        'blanqueo_prioA_final','blanqueo_prioB_final','blanqueo_prioC_final',
        'blanqueo_prioA_pen', 'blanqueo_prioB_pen','blanqueo_prioC_pen'

      ));



          
        }


    public function chartArea()
      {  
        //variables para recoger el numero de tarjetas finalizadas en cada planta
        $num_nsd = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '2'])->count();
        $num_combi = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '1'])->count();
        $num_sulfonacion = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '3'])->count();
        $num_calderas = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '4'])->count();
        $num_oficinasadmin = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '7'])->count();
        $num_blanqueo = TarjetasModel::where(['status' => 'Finalizada'])->where(['planta_id' => '6'])->count();

        //variables para recoger el numero de tarjetas pendientes en cada planta
        $pen_nsd = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '2'])->count();
        $pen_combi = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '1'])->count();
        $pen_sulfonacion = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '3'])->count();
        $pen_calderas = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '4'])->count();
        $pen_oficinasadmin = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '7'])->count();
        $pen_blanqueo = TarjetasModel::where(['status' => 'Pendiente'])->where(['planta_id' => '6'])->count();

        //variables para la graficas de areas
        $empaqueAF = TarjetasModel::where(['status' => 'Finalizada'])->where(['area_id' => '1'])->where(['prioridad' => 'A'])->count();
        $empaqueBF = TarjetasModel::where(['status' => 'Finalizada'])->where(['area_id' => '1'])->where(['prioridad' => 'B'])->count();
        $empaqueCF = TarjetasModel::where(['status' => 'Finalizada'])->where(['area_id' => '1'])->where(['prioridad' => 'C'])->count();
        $empaqueAP = TarjetasModel::where(['status' => 'Pendiente'])->where(['area_id' => '1'])->where(['prioridad' => 'A'])->count();
        $empaqueBP = TarjetasModel::where(['status' => 'Pendiente'])->where(['area_id' => '1'])->where(['prioridad' => 'B'])->count();
        $empaqueCP = TarjetasModel::where(['status' => 'Pendiente'])->where(['area_id' => '1'])->where(['prioridad' => 'C'])->count();

        $secado1AF = TarjetasModel::where(['status' => 'Finalizada'])->where(['area_id' => '2'])->where(['prioridad' => 'A'])->count();
        $secado1BF = TarjetasModel::where(['status' => 'Finalizada'])->where(['area_id' => '2'])->where(['prioridad' => 'B'])->count();
        $secado1CF = TarjetasModel::where(['status' => 'Finalizada'])->where(['area_id' => '2'])->where(['prioridad' => 'C'])->count();
        $secado1AP = TarjetasModel::where(['status' => 'Pendiente'])->where(['area_id' => '2'])->where(['prioridad' => 'A'])->count();
        $secado1BP = TarjetasModel::where(['status' => 'Pendiente'])->where(['area_id' => '2'])->where(['prioridad' => 'B'])->count();
        $secado1CP = TarjetasModel::where(['status' => 'Pendiente'])->where(['area_id' => '2'])->where(['prioridad' => 'C'])->count();

        $secado2AF = TarjetasModel::where(['status' => 'Finalizada'])->where(['area_id' => '3'])->where(['prioridad' => 'A'])->count();
        $secado2BF = TarjetasModel::where(['status' => 'Finalizada'])->where(['area_id' => '3'])->where(['prioridad' => 'B'])->count();
        $secado2CF = TarjetasModel::where(['status' => 'Finalizada'])->where(['area_id' => '3'])->where(['prioridad' => 'C'])->count();
        $secado2AP = TarjetasModel::where(['status' => 'Pendiente'])->where(['area_id' => '3'])->where(['prioridad' => 'A'])->count();
        $secado2BP = TarjetasModel::where(['status' => 'Pendiente'])->where(['area_id' => '3'])->where(['prioridad' => 'B'])->count();
        $secado2CP = TarjetasModel::where(['status' => 'Pendiente'])->where(['area_id' => '3'])->where(['prioridad' => 'C'])->count();

        $secado3AF = TarjetasModel::where(['status' => 'Finalizada'])->where(['area_id' => '17'])->where(['prioridad' => 'A'])->count();
        $secado3BF = TarjetasModel::where(['status' => 'Finalizada'])->where(['area_id' => '17'])->where(['prioridad' => 'B'])->count();
        $secado3CF = TarjetasModel::where(['status' => 'Finalizada'])->where(['area_id' => '17'])->where(['prioridad' => 'C'])->count();
        $secado3AP = TarjetasModel::where(['status' => 'Pendiente'])->where(['area_id' => '17'])->where(['prioridad' => 'A'])->count();
        $secado3BP = TarjetasModel::where(['status' => 'Pendiente'])->where(['area_id' => '17'])->where(['prioridad' => 'B'])->count();
        $secado3CP = TarjetasModel::where(['status' => 'Pendiente'])->where(['area_id' => '17'])->where(['prioridad' => 'C'])->count();
         
      // dd($secado3CF);

       return view('graficasA', compact(
                'num_nsd','num_combi','num_sulfonacion','num_calderas','num_oficinasadmin','num_blanqueo',
                 'pen_nsd','pen_combi','pen_sulfonacion','pen_calderas','pen_oficinasadmin','pen_blanqueo',
                 'empaqueAF','empaqueBF','empaqueCF','empaqueAP','empaqueBP','empaqueCP',
                 'secado1AF','secado1BF','secado1CF','secado1AP','secado1BP','secado1CP',
                 'secado2AF','secado2BF','secado2CF','secado2AP','secado2BP','secado2CP',
                 'secado3AF','secado3BF','secado3CF','secado3AP','secado3BP','secado3CP'
        ));
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
