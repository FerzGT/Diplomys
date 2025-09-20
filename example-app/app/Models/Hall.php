<?php

namespace App\Models;

use App\Models\Session;
use App\Models\Place;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hall extends Model
{
     use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name',
        'rows',
        'cols',
        'place',
        'price',
        'price_vip',
        'is_open',
    ];

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    public function seat()
    {
        return $this->hasMany(Place::class);
    }
}
