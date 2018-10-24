<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificacion_Freelancer extends Model
{
    protected $table='certificacion_freelancer';
    public $primaryKey = 'id_certificacion_freelancer';
    public $incrementing = true;
    protected $dateFormat = 'M j Y h:i:s';
    protected $fillable = ['expedicion', 'vencimiento', 'id_cert', 'id_user'];
    public $timestamps = false;
}
