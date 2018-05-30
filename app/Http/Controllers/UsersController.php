<?php

namespace App\Http\Controllers;

use App\User;
use App\PuestosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\RegistersUsers;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\UsersFormRequest;

class UsersController extends Controller
{

use RegistersUsers;
//middleware para dar paso solo a usuarios autentificados

  public function __construct()
  {
  $this->middleware('auth');
  }


    public function index(Request $request)
    {
      $users=User::orderBy('id','DESC')->get();
      return view('users.index',compact('users'));
    }

//funcion para mandar listado de usuarios por medio de json
    public function users_json($filtro)
    {
        return User::where('name','LIKE','%'.$filtro.'%')->get();
      /*if ($request->ajax()){
        //return User::get(['id','name']);
        return response()->json([
          'mensaje'=>$filtro
        ])
      }*/


    }

    public function create()
    {

      $roles=Role::All();
      $puestos=PuestosModel::get();
      return view('users.create',compact('puestos','roles'));
    }

//funcion para guardar un nuevo empleado, recibe datos desde la vista html
    public function store(UsersFormRequest $request)
    {
      $user=new User;
      $user->name=$request->get('nombre');
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
        $user=User::findOrFail($id);
        $puestos=PuestosModel::get();
        return view('users.perfil',compact('user','puestos'));
    }


    public function edit($id)
    {
  return view('users.edit',["user"=>User::findOrFail($id)]);
    }


    public function change_password(){


    }


    public function update(Request $request,$id)
    {
      $user=User::findOrFail($id);
      $user->name=$request->get('nombre');
      $user->codigoempleado=$request->get('codigo');
      $user->puesto_id=$request->get('puesto_id');
      $user->email=$request->get('email');
      //$user->rol_id=$request->get('rol_id');
      $user->update();
      return Redirect::to('users/'.$id);
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
