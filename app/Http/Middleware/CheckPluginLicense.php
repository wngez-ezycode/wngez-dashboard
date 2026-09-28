<?php

namespace App\Http\Middleware;

use App\Models\PluginLicense;
use App\Services\License\LicenseVerifier;
use Closure;
use Illuminate\Http\Request;

class CheckPluginLicense
{
    public function __construct(protected LicenseVerifier $verifier) {}

    public function handle(Request $request, Closure $next, string $slug)
    {
        return $next($request);
    }
}
