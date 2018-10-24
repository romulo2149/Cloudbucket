<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $dateFormat = 'M j Y h:i:s';
    
    protected $fillable = [
        'name', 'email', 'password', 'rol', 'nombre', 'apellidos', 'nombre_empresa', 'domicilio', 'telefono', 'valoracion', 'fecha_nacimiento', 'sitio_web', 'salario_hora', 'empresa'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}