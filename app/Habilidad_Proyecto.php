<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habilidad_Proyecto extends Model
{
    protected $table='habilidad_proyecto';
    public $primaryKey = 'id_habilidad';
    public $incrementing = true;
    protected $fillable = ['id_proyecto', 'habilidad'];
    public $timestamps = false;
}
