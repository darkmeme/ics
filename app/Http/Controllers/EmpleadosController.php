<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\RolesModel;
use App\PuestosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\RegistersUsers;

class EmpleadosController extends Controller
{

use RegistersUsers;
//middleware para dar paso solo a usuarios autentificados

  public function __construct()
  {
      $this->middleware('auth');
      //$this->middleware(['role:administrador']);
      //$this->middleware(['role:Administrador','permission:publish articles|edit articles']);

  }



    public function index(Request $request)
    {
$roles = $user->getRoleNames(); // Returns a collection
       dd($$roles);
      $empleados=Empleado::with('Rol')->get();

      return view('empleados.index',compact('empleados'));
    }


    public function create()
    {

      $roles=RolesModel::All();
      $puestos=PuestosModel::get();
      //dd($puestos);
      return view('empleados.create',compact('roles','puestos'));
    }

//funcion para guardar un nuevo empleado, recibe datos desde la vista html
    public function store(Request $request)
    {
      $empleados=new Empleado;
      $empleados->nombre=$request->get('empleado');
      $empleados->codigoempleado=$request->get('codigo');
      $empleados->puesto_id=$request->get('puesto_id');
      $empleados->rol_id=$request->get('rol_id');
      $empleados->email=$request->get('email');
      // funcion crypt encripta la contrasena que viene del formulario
      $empleados->password = bcrypt($request['password']);
      $empleados->save();
      return Redirect::to('empleados');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
  return view('empleados.edit',["empleados"=>Empleado::findOrFail($id)]);
    }


    public function update(Request $request,$id)
    {
      $empleados=Empleado::findOrFail($id);
      $empleados->nombre=$request->get('nombre');
      $empleados->codigoempleado=$request->get('codigo');
      $empleados->puesto_id=$request->get('puesto_id');
      $empleados->rol_id=$request->get('rol_id');
      $empleados->update();
      return Redirect::to('empleados');
    }

//funcion para eliminar un usuario por su id
    public function destroy($id)
    {
      $empleados=Empleado::findOrFail($id);
      $empleados->Delete();
      //Post::destroy($id);
      Return Redirect::to('empleados');
    }
}
