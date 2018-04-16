<?php

namespace App\Http\Controllers;

use App\EventosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class EventosController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

    public function index(Request $request)
    {
      $eventos=EventosModel::All();
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
      return Redirect::to('eventos');
    }

    public function destroy($id)
    {
      $eventos=EventosModel::findOrFail($id);
      $eventos->Delete();
      //Post::destroy($id);
      Return Redirect::to('eventos');
    }
}
