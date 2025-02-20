<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/success',
        '/fail',
        '/cancel',
        '/ipn',
        '/success2',
        '/fail2',
        '/cancel2',
        '/ipn2',
        '/bkash/create',
        '/bkash/execute',
        'api/add-to-cart',
    ];
}
