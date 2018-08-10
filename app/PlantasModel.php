<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlantasModel extends Model
{
  protected $table='plantas';
  protected $fillable= ['nombre'];
  //protected $primaryKey= "idCategoria";

  public $timestamps=false;

  public function tarjetas()
  {
    return $this->hasMany('App\TarjetasModel', 'planta_id');
  }

  public function tarjetasRojas()
  {
    return $this->hasMany('App\TarjetasRojas', 'planta_id');
  }

}
