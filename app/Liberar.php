<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liberar extends Model
{
    protected $table='liberar';
    protected $dateFormat = 'Y-m-d h:i:s';
    public $primaryKey = 'id_liberar';
    public $incrementing = true;
    protected $fillable = ['id_user_libera', 'id_user_liberado', 'id_proyecto', 'valoracion', 'comentario'];
    public $timestamps = true;
}
