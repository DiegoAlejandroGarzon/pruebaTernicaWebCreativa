<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class tareas extends Model
{
    protected $fillable = [
        'nombre', 
        'fechaInicio', 
        'fechaFin', 
        'estado', 
        'idUser', 
    ];
}
