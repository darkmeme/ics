<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolesModel extends Model
{
  protected $table='roles';
  //protected $primaryKey= "idCategoria";

  public$timestamps=false;

  protected $fillable= [
    'nombre'
  ];


}
