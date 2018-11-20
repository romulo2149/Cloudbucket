<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progreso extends Model
{
    protected $table='progreso';
    public $primaryKey = 'id_progreso';
    public $incrementing = true;
    protected $fillable = ['nombre_progreso', 'descripcion', 'fecha_entrega', 'fecha_prorroga', 'pago_pct', 'id_proyecto'];
    public $timestamps = false;
}
