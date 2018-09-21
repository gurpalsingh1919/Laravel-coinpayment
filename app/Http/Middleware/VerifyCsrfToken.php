<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
          'ipn-handler',
          'paypalIpnHandler',
          'getAllUsers',
          'kyc-ipn-hander',
          'AnOtherIpnHandler',
          'user-kyc-hander',
          'tracking-listner',
          'sale-confirm'
          
    ];
}
