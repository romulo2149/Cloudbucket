<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table='proyecto';
    public $primaryKey = 'id_proyecto';
    public $incrementing = true;
    protected $fillable = ['titulo', 'area', 'descripcion', 'presupuesto', 'anexo', 'tiempo', 'usuario'];
    public $timestamps = false;
}
