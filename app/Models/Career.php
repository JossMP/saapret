<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{
    use HasFactory, SoftDeletes;

    function graduates()
    {
        return $this->hasMany(Graduate::class);
    }

    // slug
    function getRouteKeyName()
    {
        return 'slug';
    }
}
