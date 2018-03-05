<?php

namespace App\Http\Controllers;
use App\CategoriasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoriasController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }
  

  public function index(Request $request)
  {
    $categorias=CategoriasModel::All();
    return view('categorias.index',compact('categorias'));
  }


    public function create()
    {
        return view('categorias.create');
    }


    public function store(Request $request)
    {
      $categorias=new CategoriasModel;
      $categorias->Nombre=$request->get('categoria');
      $categorias->save();
      return Redirect::to('categorias');
    }


    public function show($id)
    {
        //return view('equipos.show',["equipos"=>EquiposModel::findOrfail($id)]);
    }


    public function edit($id)
    {
      return view('categorias.edit',["categorias"=>CategoriasModel::findOrFail($id)]);
    }


    public function update(Request $request, $id)
    {
      $categorias=CategoriasModel::findOrFail($id);
      $categorias->Nombre=$request->get('nombre');
      $categorias->update();
      return Redirect::to('categorias');
    }



    public function destroy($id)
    {
      $categorias=CategoriasModel::findOrFail($id);
      $categorias->Delete();
      //Post::destroy($id);
      return Redirect::to('categorias');
    }
}
