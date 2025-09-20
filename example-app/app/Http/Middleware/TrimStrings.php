<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings
{

    protected $except = [
        'current_password',
        'password',
        'password_confirmation',
    ];
}
