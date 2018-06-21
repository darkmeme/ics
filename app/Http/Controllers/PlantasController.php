<?php

namespace App\Http\Controllers;

use App\PlantasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PlantasController extends Controller
{
  public function __construct()
 {
     $this->middleware('auth');
  }


    public function index(Request $request)
    {
      $plantas=PlantasModel::All();
      return view('plantas.index',compact('plantas'));
    }


    public function create()
    {
        return view('plantas.create');
    }


    public function store(Request $request)
    {
      $plantas=new PlantasModel;
      $plantas->Nombre=$request->get('planta');
      $plantas->save();
      return Redirect::to('plantas');
    }


    public function show(Request $request, $id)
    {
        $tarjetasP = PlantasModel::findOrFail($id)->tarjetas;
  
          return view('plantas.tarjetas-planta', compact('tarjetasP'));

        // return response()->json([
        //  'data'=>$tarjetasP]);
     
    }


    public function edit($id)
    {
        return view('plantas.edit',["plantas"=>PlantasModel::findOrFail($id)]);
    }


    public function update(Request $request,$id)
    {
      $plantas=PlantasModel::findOrFail($id);
      $plantas->Nombre=$request->get('nombre');
      $plantas->update();
      return Redirect::to('plantas');
    }


    public function destroy($id)
    {
      $plantas=PlantasModel::findOrFail($id);
      $plantas->Delete();
      //Post::destroy($id);
      Return Redirect::to('plantas');
    }
}
