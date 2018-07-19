<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedidoresFormRequest;
use App\Medidores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use App\Mail\LecturasEnergia;

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


    public function create()
    {
        return view('medidores.create');
    }



    public function store(MedidoresFormRequest $request)
    {
      $medidores=Medidores::create($request->all());
    
      $user=Auth::user()->name;
      $emails = ['dagoberto.ortega@unilever.com', 'saul.alvarado@unilever.com'];
       Mail::to($emails)
       ->send(new LecturasEnergia($medidores,$user));
      return Redirect::to('medidores');
    }



    public function show(Medidores $medidores)
    {

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
