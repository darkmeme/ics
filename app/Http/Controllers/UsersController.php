<?php

namespace App\Http\Controllers;

use App\User;
use App\PuestosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\RegistersUsers;

class UsersController extends Controller
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
      //$roles = $user->getRoleNames(); // Returns a collection
       //dd($$roles);
      $users=User::All();
      //dd($users);
      return view('users.index',compact('users'));
    }


    public function create()
    {

      //$roles=RolesModel::All();
      $puestos=PuestosModel::get();
      //dd($puestos);
      return view('users.create',compact('puestos'));
    }

//funcion para guardar un nuevo empleado, recibe datos desde la vista html
    public function store(Request $request)
    {
      $user=new User;
      $user->name=$request->get('empleado');
      $user->codigoempleado=$request->get('codigo');
      $user->puesto_id=$request->get('puesto_id');
      //$user->rol_id=$request->get('rol_id');
      $user->email=$request->get('email');
      // funcion crypt encripta la contrasena que viene del formulario
      $user->password = bcrypt($request['password']);
      $user->save();
      return Redirect::to('users');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
  return view('users.edit',["user"=>User::findOrFail($id)]);
    }


    public function update(Request $request,$id)
    {
      $user=User::findOrFail($id);
      $user->name=$request->get('nombre');
      $user->codigoempleado=$request->get('codigo');
      $user->puesto_id=$request->get('puesto_id');
      //$user->rol_id=$request->get('rol_id');
      $user->update();
      return Redirect::to('users');
    }

//funcion para eliminar un usuario por su id
    public function destroy($id)
    {
      $user=User::findOrFail($id);
      $User->Delete();
      //Post::destroy($id);
      Return Redirect::to('users');
    }
}
