<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $dateFormat = 'Y-m-d h:i:s';
    protected $table='contrato';
    public $primaryKey = 'id_contrato';
    public $incrementing = true;
    protected $fillable = ['firma_freelancer', 'firma_cliente', 'pago', 'entrega', 'penalizacion', 'solicitud'];
    public $timestamps = true;
}
