<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ewallet extends Model
{
    protected $table='ewallet';
    public $primaryKey = 'id_wallet';
    public $incrementing = true;
    protected $fillable = ['operador', 'cuenta', 'clave', 'id_user'];
    public $timestamps = false;
}
