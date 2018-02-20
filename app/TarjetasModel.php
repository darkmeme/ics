<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TarjetasModel extends Model
{
  protected $table='tarjetas';

  protected $fillable=['empleado_id','area_id','equipo_id','prioridad',
  'descripcion_reporte','empleado_finaliza','categoria_id','solucion_implementada','evento_id','turno',
  'causa_id','fecha_cierre','finalizado','status','planta_id','empleado_asignado'];

  //public $timestamps=false ;
  public function causa()
    {
      return $this->belongsTo('App\CausasModel');
    }

  public function categoria()
    {
      return $this->belongsTo('App\CategoriasModel');
    }

  public function evento()
    {
      return $this->belongsTo('App\EventosModel');
    }

  public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function asignado()
      {
        return $this->belongsTo('App\User','user_asignado');
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
