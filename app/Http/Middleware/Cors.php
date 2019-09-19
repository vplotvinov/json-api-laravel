<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class Cors
{
    private static $allowedOriginsWhitelist = [];

    // All the headers must be a string

    private static $allowedOrigin = 'https://app.website.one; https://website.one;';

    private static $allowedMethods = 'OPTIONS, GET, POST, PUT, PATCH, DELETE';

    private static $allowCredentials = 'true';

    private static $allowedHeaders = 'Origin, X-Requested-With, Content-Type, Accept, Authorization';

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( ! $this->isCorsRequest($request)) {
            return $next($request);
        }

        static::$allowedOriginsWhitelist[] = Config::get('app.frontend_app_url');
        static::$allowedOriginsWhitelist[] = Config::get('app.website_app_url');
        static::$allowedOriginsWhitelist[] = 'www.website.one';
        static::$allowedOriginsWhitelist[] = 'website.one';
        static::$allowedOrigin             = $this->resolveAllowedOrigin($request);

//        static::$allowedHeaders = $this->resolveAllowedHeaders($request);

        $headers = [
            'Access-Control-Allow-Origin'      => static::$allowedOrigin,
            'Access-Control-Allow-Methods'     => static::$allowedMethods,
            'Access-Control-Allow-Headers'     => static::$allowedHeaders,
            'Access-Control-Allow-Credentials' => static::$allowCredentials,
            'Access-Control-Allow-Max-Age'     => '84000',

        ];

        // For preflighted requests
        if ($request->getMethod() === 'OPTIONS') {
            return response('', 200)->withHeaders($headers);
        }

        $response = $next($request)->withHeaders($headers);

        return $response;
    }

    /**
     * Incoming request is a CORS request if the Origin
     * header is set and Origin !== Host
     *
     * @param Request $request
     *
     * @return bool
     */
    private function isCorsRequest($request): bool
    {
        $requestHasOrigin = $request->headers->has('Origin');

        if ($requestHasOrigin) {
            $origin = $request->headers->get('Origin');

            $host = $request->getSchemeAndHttpHost();

            if ($origin !== $host) {
                return true;
            }
        }

        return false;
    }

    /**
     * Dynamic resolution of allowed origin since we can't
     * pass multiple domains to the header. The appropriate
     * domain is set in the Access-Control-Allow-Origin header
     * only if it is present in the whitelist.
     *
     * @param Request $request
     */
    private function resolveAllowedOrigin($request)
    {
        $allowedOrigin = static::$allowedOrigin;

        // If origin is in our $allowedOriginsWhitelist
        // then we send that in Access-Control-Allow-Origin

        $origin = $request->headers->get('Origin');

        if (in_array($origin, static::$allowedOriginsWhitelist)) {
            $allowedOrigin = $origin;
        }

        return $allowedOrigin;
    }

    /**
     * Take the incoming client request headers
     * and return. Will be used to pass in Access-Control-Allow-Headers
     *
     * @param Request $request
     */
    private function resolveAllowedHeaders($request)
    {
        $allowedHeaders = $request->headers->get('Access-Control-Request-Headers');

        return $allowedHeaders;
    }
}
