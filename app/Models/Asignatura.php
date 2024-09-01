<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;

    protected $table  = 'asignatura'; //? Se asocia a la tabla asignatura

    protected $fillable = [ //? Se le ponen todos los atributos que se le crearon a la tabla, en este caso sólo nombre (ver en la database/migrations )
        'nombre'
    ];
}

//? Esta es un modelo creado con el comando php artisan make:model Asignatura