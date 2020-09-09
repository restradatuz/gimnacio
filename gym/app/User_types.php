<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class User_types extends Model
{
	protected $table='user_types';
 	protected $fillable=['nombre'];
	
}
