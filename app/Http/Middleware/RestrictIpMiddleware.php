<?php

namespace App\Http\Middleware;

use App\Services\AllowedIpService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RestrictIpMiddleware
{
    private $service;

    public function __construct(AllowedIpService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ipAddress = $request->ip();
        $expIpAddress = explode('.', $ipAddress);

        $listOfAllowedIps = $this->service->index();

        foreach ($listOfAllowedIps as $allowedIp) {
            $expAllowedIp = explode('.', $allowedIp);

            foreach ($expAllowedIp as $key => $value) {
                if ($value === '*') continue; // if wildcard, auto-pass.

                // str_contains return true when searching an empty string
                // Therefore we abort empty string early.
                if (strlen($expIpAddress[$key]) <= 0) abort(423); 

                // if doesnt't match with allowed ips, abort.
                if (!str_contains($value, $expIpAddress[$key])) abort(423);
            }
        }

        return $next($request);
    }
}
