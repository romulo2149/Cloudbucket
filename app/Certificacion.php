<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificacion extends Model
{
    protected $table='certificacion';
    public $primaryKey = 'id_certificacion';
    public $incrementing = true;
    protected $fillable = ['nombre', 'compañia'];
    public $timestamps = false;
}
