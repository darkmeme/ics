<?php

namespace App\Http\Controllers;

use App\CausasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class CausasController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }



    public function index(Request $request)
    {
      $causas=CausasModel::All();
      //dd($causas);
      return view('causas.index',compact('causas'));
    }

    public function create()
    {
        return view('causas.create');
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => 'required|string|max:50',
        ]);
    }


    public function store(Request $request)
    {
      $causas=new CausasModel;
      $causas->nombre=$request->get('causa');
      $causas->save();
      return Redirect::to('causas');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('causas.edit',["causas"=>CausasModel::findOrFail($id)]);
    }

    public function update(Request $request,$id)
    {
      $causas=CausasModel::findOrFail($id);
      $causas->nombre=$request->get('nombre');
      $causas->update();
      return response()->json($causas);
    }

    public function destroy($id)
    {
      $causas=CausasModel::findOrFail($id);
      $causas->Delete();
      //Post::destroy($id);
      return response()->json($causas);
    }
}
