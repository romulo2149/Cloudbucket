<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table='areas';
    public $primaryKey = 'id_area';
    public $incrementing = true;
    protected $fillable = ['titulo'];
    public $timestamps = false;
}
