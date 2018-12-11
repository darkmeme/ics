<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ajuste extends Model
{
    protected $table='ajustes';
    protected $fillable=['id','ajuste','valor'];
}
