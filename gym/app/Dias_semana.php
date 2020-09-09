<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Dias_semana extends Model
{
	protected $table='dias_semana';
 	protected $fillable=['dia_semana','id_horario','id_semanacarbon','estatus','id_sucursal'];


 	public function nombrehorario() {
		return $this->belongsTo(Horario::class, 'id_horario');
	}

	
}
