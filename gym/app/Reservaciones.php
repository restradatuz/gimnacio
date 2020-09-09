<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservaciones extends Model
{
	protected $table='reservaciones';
 	protected $fillable=['id_cliente','id_horario','id_horario_detalle','fecha_citagym','horario','cancelado','fecha_registro'];


 	public function promotor() {
		return $this->belongsTo(User::class, 'id_cliente');
	}

	
}
