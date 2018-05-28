<?php

namespace App\Http\Controllers;

use App\EquiposModel;
use App\AreasModel;
use App\PlantasModel;
use Illuminate\Http\Request;
use App\Http\Requests\EquiposFormRequest;
use Illuminate\Support\Facades\Redirect;

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
      return Redirect::to('equipos');
    }



    public function destroy($id)
    {
      $equipos=EquiposModel::findOrFail($id);
      $equipos->Delete();
      //Post::destroy($id);
      Return Redirect::to('equipos');
    }
}
