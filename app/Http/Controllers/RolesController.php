<?php

namespace App\Http\Controllers;

use App\RolesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade as PDF;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;


class RolesController extends Controller
{


  public function __construct()
  {
      $this->middleware('auth');
  }

    public function index(Request $request)
    {
      $roles=Role::All();
      $usuarios=User::All();
      $permisos=Permission::All();

      return view('roles.index',compact('roles','usuarios','permisos'));
    }


    public function create_permission(Request $request){
      //funciones para crear roles y permisos
      //$role = Role::create(['name' =>$request['rol']]);
      $permission = Permission::create(['name' => $request['permiso']]);
      return Redirect::to('roles');
      //$role=Role::findOrFail(1);
      //dd($role);
    //  $permission=Permission::findOrFail(2);
    //  $user=User::findOrFail(4);
      //dd($user);
      //$user->assignRole($role);
    //  $user->hasRole($role);
      //$user->hasAnyRole(Role::all());
    //  dd($user);
      //$role->givePermissionTo($permission);
    //  $permission->assignRole($role);
    }

    public function asignar_rol(Request $request)
    {
     $user=User::findOrFail(311);
     $role=Role::findOrFail(1);
     //$permiso=Permission::findOrFail(1);
     $user->assignRole($role);
     //$role->givePermissionTo(['publish articles', 'unpublish articles']);
    }




public function asignar_permiso(Request $request){
  //dd($rol,$permiso);
  $rol=Role::findOrFail(1);
  $permiso=Permission::findOrFail(4);
  //dd($rol,$permiso);
  $rol->givePermissionTo($permiso);
  //$permission->assignRole($rol);
}



    public function create()
    {

    }


    public function store(Request $request)
    {
      $role = Role::create(['name' =>$request['rol']]);
      return Redirect::to('roles');
    }


    public function show($id)
    {

    }


    public function edit($id)
    {
      return view('roles.edit',["roles"=>RolesModel::findOrFail($id)]);
    }


    public function update(Request $request,$id)
    {
      $roles=RolesModel::findOrFail($id);
      $roles->Nombre=$request->get('nombre');
      $roles->update();
      return Redirect::to('roles');
    }


    public function destroy($id)
    {
      $roles=Role::findOrFail($id);
      $roles->Delete();
      //Post::destroy($id);
      Return Redirect::to('roles');
    }


    public function delete_permission($id)
    {
      $permiso=Permission::findOrFail($id);
      $permiso->Delete();
      //Post::destroy($id);
      Return Redirect::to('roles');
    }




    public function pdf()
      {
          $datos = RolesModel::All();
          $date = date('Y-m-d');
          $view =  \View::make('pdf.ReporteRoles', compact('datos', 'date'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          return $pdf->stream('ReporteRoles');
      }

}
