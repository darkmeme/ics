<?php

namespace App\Http\Controllers;

use App\Medidores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MedidoresController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

    public function index()
    {
      $medidores=Medidores::All();
      return view('medidores.index',compact('medidores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medidores.create');
    }



    public function store(Request $request)
    {
      $medidores=new Medidores;
      $medidores->nsd_220=$request->get('nsd_220');
      $medidores->nsd_480=$request->get('nsd_480');
      $medidores->blanqueo=$request->get('blanqueo');
      $medidores->calderas=$request->get('calderas');
      $medidores->sulfonacion=$request->get('sulfonacion');
      $medidores->oficinas=$request->get('oficinas');
      $medidores->daf=$request->get('daf');
      $medidores->comby=$request->get('comby');
      $medidores->saponificacion=$request->get('saponificacion');
      $medidores->enee_principal=$request->get('enee_principal');
      $medidores->enee_reactivo=$request->get('enee_reactivo');
      $medidores->fp=$request->get('fp');
      $medidores->save();
      return Redirect::to('medidores');
    }



    public function show(Medidores $medidores)
    {
        //
    }



    public function edit(Medidores $medidores)
    {
        //
    }


    public function update(Request $request, Medidores $medidores)
    {
        //
    }


    public function destroy(Medidores $medidores)
    {
        //
    }
}
