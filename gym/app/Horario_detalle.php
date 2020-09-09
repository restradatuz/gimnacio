<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario_detalle extends Model
{
	protected $table='horario_detalle';
 	protected $fillable=['id_horario','horario','consecutivo','id_sucursal'];
	
}
