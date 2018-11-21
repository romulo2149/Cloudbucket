<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $dateFormat = 'Y-m-d h:i:s';
    protected $table='mensaje';
    public $primaryKey = 'id_mensaje';
    public $incrementing = true;
    public $fillable = ['id_user', 'chat', 'mensaje', 'leido'];
    public $timestamps = true;
}
