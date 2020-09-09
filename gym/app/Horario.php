<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
	protected $table='horarios';
 	protected $fillable=['nombre_horario','id_sucursal'];
	
}
