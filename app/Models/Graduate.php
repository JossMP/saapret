<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Graduate extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    // Datois Personales
    function person()
    {
        return $this->belongsTo(Person::class);
    }

    // Carrera profesional
    function career()
    {
        return $this->belongsTo(Career::class);
    }
    // Grado Obtenido
    function degree()
    {
        return $this->belongsTo(Degree::class);
    }
}
