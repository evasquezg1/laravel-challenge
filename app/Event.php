<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'evento';

    protected $fillable = [
    		'titulo', 'descripcion', 'fecha_i', 'fecha_f'
    ];

    public $timestamps = false;
}
