<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    // Lista de carreras de las que se graduo | egreso
    function graduates()
    {
        return $this->hasMany(Graduate::class)->orderBy('order');
    }
    function experiences()
    {
        return $this->hasMany(Experience::class)->orderBy('order');
    }
    function certificates()
    {
        return $this->hasMany(Certificate::class)->orderBy('order');
    }

    function district_home()
    {
        return $this->belongsTo(District::class, 'location_home');
    }

    function district_birth()
    {
        return $this->belongsTo(District::class, 'location_birth');
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }


    /* ***************** */
    public function getPhotoAttribute($value)
    {
        if ($value != null)
            return url('storage/photos/' . $value);
        return url('images/photos/default.png');
    }

    // slug
    function getRouteKeyName()
    {
        return 'slug';
    }
}
