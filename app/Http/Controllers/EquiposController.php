<?php

namespace App\Http\Controllers;

use App\EquiposModel;
use App\AreasModel;
use App\PlantasModel;
use App\TarjetasModel;
use Illuminate\Http\Request;
use App\Http\Requests\EquiposFormRequest;
use Illuminate\Support\Facades\Redirect;
use Brian2694\Toastr\Facades\Toastr;

class EquiposController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

// funcion para cargar los equipos por medio de las areas, peticion ajax desde jquery
public function equipos_areas($id)
{
  return EquiposModel::where('area_id',$id)->get();
}

// funcion para llamar a los equipos padres

public function equipos_padres($id)
{
  return EquiposModel::where('area_id',$id)->where('padre',1)->get();
}

  public function index(Request $request)
  {
    $equipos=EquiposModel::All();
    return view('equipos.index',compact('equipos'));
  }


  public function mostrarEquipos(){
  $listEquipos=EquiposModel::orderBy('id','desc')->get();
  return $listEquipos;
  }



    public function create()
    {
        //$areas=AreasModel::All();
        $plantas=PlantasModel::All();
        return view('equipos.create',compact('plantas'));
    }


    public function store(Request $request)
    {
      $equipos=new EquiposModel;
      $equipos->nombre=$request->get('equipo');
      $equipos->area_id=$request->get('area_id');
      $equipos->equipo_id=$request->get('equipo_id');
      $equipos->padre=$request->get('combo-padre');
      $equipos->save();
      Toastr::success('Equipo creado correctamente');
      return Redirect::to('equipos');
    }


    public function edit($id)
    {
      return view('equipos.edit',["equipos"=>EquiposModel::findOrFail($id)]);
    }


    public function update(Request $request, $id)
    {
      $equipos=EquiposModel::findOrFail($id);
      $equipos->nombre=$request->get('nombre');
      $equipos->area_id=$request->get('area_id');
      $equipos->update();
      Toastr::success('Equipo editado correctamente');
      return Redirect::to('equipos');
    }



    public function destroy($id)
    {
      //confirmar si esta en uso en alguna tarjeta
      $tarjeta=TarjetasModel::where('equipo_id',$id)->get()->first();
      $subequipo=EquiposModel::where('equipo_id',$id)->get()->first();
      if (count($tarjeta)>0 or (count($subequipo)>0)){
        Toastr::error('No se puede borrar este equipo, esta en uso' ,'Error');
        Return Redirect::to('equipos');
      }
      else{
      $equipos=EquiposModel::findOrFail($id);
      $equipos->Delete();
      Toastr::success('Equipo eliminado correctamente');
      Return Redirect::to('equipos');
      }
    }
}
