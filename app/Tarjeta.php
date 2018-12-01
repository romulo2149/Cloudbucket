<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    protected $table='tarjeta';
    public $primaryKey = 'id_tarjeta';
    public $incrementing = true;
    protected $fillable = ['operador', 'numero', 'terminacion', 'codigo', 'vencimiento', 'nombre'];
    public $timestamps = false;
}
