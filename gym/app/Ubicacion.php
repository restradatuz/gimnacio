<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
	protected $table='ubicaciones';
 	protected $fillable=['nombre','cordenadas1','cordenadas2','id_sucursal'];

	
}
