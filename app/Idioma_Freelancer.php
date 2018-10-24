<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idioma_Freelancer extends Model
{
    protected $table='idioma_freelancer';
    public $primaryKey = 'id_idioma_freelancer';
    public $incrementing = true;
    protected $fillable = ['porcentaje', 'id_user', 'id_idioma'];
    public $timestamps = false;
}
