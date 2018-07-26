<?php

namespace App\Http\Controllers;

use App\EventosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\TarjetasModel;
use Brian2694\Toastr\Facades\Toastr;


class EventosController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

    public function index(Request $request)
    {
      $eventos=EventosModel::orderBy('id','DESC')->get();
      return view('eventos.index',compact('eventos'));
    }


    public function create()
    {
          return view('eventos.create');
    }


    public function store(Request $request)
    {
      $eventos=new EventosModel;
      $eventos->Nombre=$request->get('eventos');
      $eventos->save();
      Toastr::success('Evento creado correctamente');
      return Redirect::to('eventos');
    }



    public function edit($id)
    {
        return view('eventos.edit',["eventos"=>EventosModel::findOrFail($id)]);
    }


    public function update(Request $request,$id)
    {
      $eventos=EventosModel::findOrFail($id);
      $eventos->Nombre=$request->get('nombre');
      $eventos->update();
      
      return response()->json($eventos);
    }

    public function destroy($id)
    {

        $eventos=EventosModel::findOrFail($id);
        $eventos->Delete();
        
        return response()->json($eventos);
      
      
    }
}
