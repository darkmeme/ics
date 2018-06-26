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
      $tarjetasP = PlantasModel::findOrFail($id)->tarjetas;
      $totalTarjetas=$tarjetasP->count();
      
     // $totalTarjetas=PlantasModel::findOrFail($id)->tarjetas->count();
     // $totalEmitidas=PlantasModel::findOrFail($id)->tarjetas->where(['status' => 'Asignada'])->count();
      //TarjetasModel::where(['status' => 'Asignada'])->count();
      //$totalReasignadas=TarjetasModel::where(['status' => 'Reasignada'])->count();
     // $totalFinalizadas=TarjetasModel::where(['status' => 'Finalizada'])->count();
      
      
  
         return view('plantas.tarjetas-planta', compact('tarjetasP', 'totalTarjetas'));

         //return response()->json([
        // 'data'=>$totalEmitidas]);
     
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
      
      Return Redirect::to('plantas');
    }
}
