<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReglasNegocio extends Model
{
    protected $table = 'reglas_negocio';
    protected $fillable=['dias','cantidad_gym','cliente_reservacionxdia','resevaciones_permitidas','usuario','id_sucursal'];
}
