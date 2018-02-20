<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordenes extends Model
{
    protected $table='ordenes';
    protected $fillable=['descripcion','user_id','planta_id','equipo_id','asignado',
  'Fecha_ejecucion'];

  public function planta()
    {
      return $this->belongsTo('App\PlantasModel');
    }

}
