<?php

namespace App\Http\Controllers;

use App\AreasModel;
use App\PlantasModel;
use App\TarjetasModel;
use App\EquiposModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\AreasFormRequest;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;

class AreasController extends Controller
{ 
  // metodo constructor con autentificacion de usuarios
 public function __construct()
  {
      $this->middleware('auth');
  }

// metodo para la peticion ajax, llena combo de areas por cada planta
  public function areas_plantas($id)
  {
    return AreasModel::where('planta_id',$id)->get();
  }


//funcion para mostrar la vista index
    public function index(Request $request)
    {
     $areas=AreasModel::orderBy('id',"DESC")->get();
     $plantas=PlantasModel::orderBy('id','DESC')->get();
        // if ($request->ajax()){
          //return response()->json([
         // 'data'=>$areas]);
        // }
       return view('areas.index')->with(['plantas'=>$plantas,'areas'=>$areas]);
   // return view('areas.index')->with(['areas' => $areas]);
        
    }

    //funcion para mostrar todo el listado de areas en la vista
    public function mostrarAreas(){
      $areas=AreasModel::with('planta')->orderBy('id','DESC')->get();
      return $areas;
    }

    //no necesaria ya que se crea mediante modal y los datos de plantas se envian a index
    /*public function create()
    {
        $plantas=PlantasModel::All();
        return view('areas.create',compact('plantas'));
    }*/

    public function show(Request $request, $id)
    {
      $area = AreasModel::find($id);
      $nombre = $area->nombre;
      $areaTarjetas =$area->tarjetasA;
      $totalTarjetas=$areaTarjetas->count();
      $TarjetasFinalizadas=$area->tarjetasA->where('status','Finalizada')->count();
      $TarjetasAsignadas=$area->tarjetasA->where('status','Asignada')->count();
      $TarjetasReasignadas=$area->tarjetasA->where('status','Reasignada')->count();
     
         return view('areas.tarjetas-area', compact('areaTarjetas', 'totalTarjetas','TarjetasFinalizadas',
         'TarjetasAsignadas','TarjetasReasignadas', 'nombre'));
     
    }

    public function store(Request $request)
    {
      $areas=new AreasModel;
      $areas->nombre=$request->get('nombre');
      $areas->planta_id=$request->get('planta_id');
      $areas->subArea=$request->get('subArea');
      $areas->save();
      Toastr::success('Area creada correctamente');
      return Redirect::to('areas');
    }


    public function edit($id)
    {
          return view('areas.edit',["areas"=>AreasModel::findOrFail($id)]);
    }


    public function update(Request $request, $id)
    {
      $areas=AreasModel::findOrFail($id);
      $areas->nombre=$request->get('nombre');
      $areas->planta_id=$request->get('planta_id');
      $areas->update();
      return response()->json($areas);
    }


    public function destroy($id)
    {

      $areas=AreasModel::findOrFail($id);
      $areas->Delete();
      return response()->json($areas);
    
    }

}
