<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table='chat';
    public $primaryKey = 'id_chat';
    public $incrementing = true;
    public $fillable = ['id_user_a', 'id_user_b'];
    public $timestamps = false;
}
