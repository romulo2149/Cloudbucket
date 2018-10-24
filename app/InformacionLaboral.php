<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InformacionLaboral extends Model
{
    protected $table='informacion_laboral';
    public $primaryKey = 'id_laboral';
    public $incrementing = true;
    protected $dateFormat = 'M j Y h:i:s';
    protected $fillable = ['cargo', 'institucion', 'fecha_inicio', 'fecha_fin', 'id_user'];
    public $timestamps = false;
}
