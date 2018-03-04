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

/*
Validator::make($request->all(), [
    'title' => 'required|max:255',
    'item' => 'required'
])->validate();

return response()->json([
    'status' => 'success',
    'msg' => 'New item has been saved'
]);

return response()->json([
    'status' => 'success',
    'id' => $list->id,
    'title' => $list->title,
    'item' => $list->item,
]);

*/



// metodo para la peticion ajax, llena combo de areas por cada planta
  public function areas_plantas($id)
  {
    return AreasModel::where('planta_id',$id)->get();
  }

    public function index(Request $request)
    {
      //$plantas=PlantasModel::All();
      $areas=AreasModel::All();
      return view('areas.index',compact('areas'));
    }


    public function create()
    {
        $plantas=PlantasModel::All();
        return view('areas.create',compact('plantas'));
    }


    public function store(Request $request)
    {
      $areas=new AreasModel;
      $areas->nombre=$request->get('areas');
      $areas->planta_id=$request->get('planta_id');
      $areas->subArea=$request->get('subArea');
      $areas->save();
      return Redirect::to('areas');
    }


    public function show($id)
    {
        //
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
      Return Redirect::to('areas');
    }
}
