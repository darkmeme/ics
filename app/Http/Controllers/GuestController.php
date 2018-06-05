<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Brian2694\Toastr\Facades\Toastr;

class GuestController extends Controller
{
    
public function verify($code)
{
    $user= User::where('confirmation_code',$code)->first();
    if (! $user)
    return redirect('/login');

    $user->confirmed = true;
    $user->confirmation_code = null;
    $user->save();
    //Toastr::success('Usuario Confirmado Satisfactoriamente :)' ,'Success');
    //return redirect('/login')->with('success', 'Usuario confirmado correctamente, ya puedes iniciar sesion');
    return redirect(route('login'))->with('success','Usuario confirmado correctamente, ya puedes iniciar sesion');
    }
}
