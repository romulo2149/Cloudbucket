<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InformacionAcademica extends Model
{
    protected $table='informacion_academica';
    public $primaryKey = 'id_laboral';
    public $incrementing = true;
    protected $dateFormat = 'M j Y h:i:s';
    protected $fillable = ['nivel', 'institucion', 'fecha_inicio', 'fecha_fin', 'id_user'];
    public $timestamps = false;
}
