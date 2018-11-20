<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table='solicitud';
    public $primaryKey = 'id_solicitud';
    public $incrementing = true;
    protected $fillable = ['mensaje', 'estatus', 'limite', 'id_proyecto', 'id_user'];
    public $timestamps = false;
}
