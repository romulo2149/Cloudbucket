<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $table='habilidad_freelancer';
    public $primaryKey = 'id_habilidad';
    public $incrementing = true;
    protected $fillable = ['user', 'habilidad'];
    public $timestamps = false;
}
