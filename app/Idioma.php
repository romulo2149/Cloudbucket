<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{
    protected $table='idioma';
    public $primaryKey = 'id_idioma';
    public $incrementing = true;
    protected $fillable = ['idioma'];
    public $timestamps = false;
}
