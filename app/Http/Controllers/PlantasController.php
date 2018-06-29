<?php

namespace App\Http\Controllers;

use App\PlantasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\TarjetasModel;

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
      $tarjetasP = PlantasModel::find($id)->tarjetas;
      $totalTarjetas=$tarjetasP->count();
      $TarjetasFinalizadas=PlantasModel::find($id)->tarjetas->where('status','Finalizada')->count();
      $TarjetasAsignadas=PlantasModel::find($id)->tarjetas->where('status','Asignada')->count();
      $TarjetasReasignadas=PlantasModel::find($id)->tarjetas->where('status','Reasignada')->count();
     
         return view('plantas.tarjetas-planta', compact('tarjetasP', 'totalTarjetas','TarjetasFinalizadas',
         'TarjetasAsignadas','TarjetasReasignadas'));
     
    }


    public function edit($id)
    {
        return view('plantas.edit',["plantas"=>PlantasModel::findOrFail($id)]);
    }


    public function update(Request $request,$id)
    {
      $plantas=PlantasModel::findOrFail($id);
      $plantas->nombre=$request->nombre;
      $plantas->update();
      return response()->json($plantas);
    }


    public function destroy($id, Request $request)
    {
      //dd('llego el id'.$id);
      $plantas=PlantasModel::findOrFail($id);
      $plantas->Delete();
            
      return response()->json($plantas);
      
    }
}
