<?php

namespace App\Http\Controllers;

use App\Medidores;
use Illuminate\Http\Request;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medidores  $medidores
     * @return \Illuminate\Http\Response
     */
    public function show(Medidores $medidores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medidores  $medidores
     * @return \Illuminate\Http\Response
     */
    public function edit(Medidores $medidores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medidores  $medidores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medidores $medidores)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medidores  $medidores
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medidores $medidores)
    {
        //
    }
}
