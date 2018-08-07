<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreasModel extends Model
{

  protected $table='areas';
  protected $fillable= ['nombre','planta_id','subArea'];
  //protected $primaryKey= "idCategoria";

  public $timestamps=false;

  public function planta()
    {
      return $this->belongsTo('App\PlantasModel');
    }

    public function subarea()
    {
      return $this->belongsTo('App\PlantasModel','subArea');
    }

    public function tarjetasA()
  {
    return $this->hasMany('App\TarjetasModel', 'area_id');
  }
  public function tarjetasR()
  {
    return $this->hasMany('App\TarjetasRojas', 'area_id');
  }

}
