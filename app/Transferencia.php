<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transferencia extends Model
{
    protected $table='transferencia';
    public $primaryKey = 'id_transferencia';
    public $incrementing = true;
    protected $fillable = ['nombre_banco', 'numero_sucursal', 'direccion', 'codigo_postal', 'codigo_SWIFT', 'nombre_cliente', 'CLABE', 'id_user'];
    public $timestamps = false;
}
