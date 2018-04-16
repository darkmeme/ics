<?php

namespace App\Http\Controllers;

use App\AreasModel;
use App\PlantasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\AreasFormRequest;
use Illuminate\Support\Facades\Validator;

class AreasController extends Controller
{
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
     //$areas=AreasModel::orderBy('id','DESC')->get();
        // if ($request->ajax()){
          //return response()->json([
         // 'data'=>$areas]);
        // }
       return view('areas.index');
   // return view('areas.index')->with(['areas' => $areas]);
        
    }

    //funcion para mostrar todo el listado de areas en la vista
    public function mostrarAreas(){
      $areas=AreasModel::with('planta')->orderBy('id','DESC')->get();
      return $areas;
    }

    public function create()
    {
        $plantas=PlantasModel::All();
        return view('areas.create',compact('plantas'));
    }


    public function store(AreasFormRequest $request)
    {
      $areas=new AreasModel;
      $areas->nombre=$request->get('nombre');
      $areas->planta_id=$request->get('planta_id');
      $areas->subArea=$request->get('subArea');
      $areas->save();
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
      return Redirect::to('areas');
    }


    public function destroy($id)
    {
      $areas=AreasModel::findOrFail($id);
      $areas->Delete();
      //Post::destroy($id);
      //Return Redirect::to('areas');
    }
}
