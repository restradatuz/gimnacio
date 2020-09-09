<?php

namespace App;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'apellido', 'email','password','tel','user_type','is_active','mensualidad','fecha_mesualidad','id_sucursal'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];


    public function tipousuario() {
        return $this->belongsTo(User_types::class, 'user_type');
    }

    public function nombresucursal() {
        return $this->belongsTo(Sucursales::class, 'id_sucursal');
    }
}
