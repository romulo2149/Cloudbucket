<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habilidad extends Model
{
    protected $table='habilidad';
    public $primaryKey = 'id_habilidad';
    public $incrementing = true;
    protected $fillable = ['titulo'];
    public $timestamps = false;
}
