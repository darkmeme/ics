<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medidores extends Model
{
  protected $table='medidores';
  protected $fillable= ['nsd_220','nsd_480','blanqueo','calderas','sulfonacion','oficinas','daf',
'comby','saponificacion','enee_principal','enee_reactivo','fp'];
}
