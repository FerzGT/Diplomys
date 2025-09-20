<?php

namespace App\Models;

use App\Models\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    public $fillable = ['title', 'duration'];

    public function sessions()
    {
        return $this->hasMany(Session::class)->orderBy('start');
    }
}
