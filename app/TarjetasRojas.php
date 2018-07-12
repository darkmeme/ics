<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TarjetasRojas extends Model
{
    protected $table='tarjeta_rojas';

    protected $fillable=['id','user_id','area_id','equipo_id','prioridad',
        'descripcion_reporte','user_finaliza','solucion_implementada','turno'
        ,'fecha_cierre','finalizado','status','planta_id','user_asignado'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function asignado()
    {
        return $this->belongsTo('App\User','user_asignado');
    }

    public function reasignado()
    {
      return $this->belongsTo('App\User','user_reasignado');
    }  

    public function terminado()
    {
        return $this->belongsTo('App\User','user_finaliza');
    }

    public function area()
    {
        return $this->belongsTo('App\AreasModel');
    }

    public function equipo()
    {
        return $this->belongsTo('App\EquiposModel');
    }

    public function planta()
    {
        return $this->belongsTo('App\PlantasModel');
    }



}
