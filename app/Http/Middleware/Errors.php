<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class Errors
{
    /**
     * @param mixed $request
     * @param Closure $next
     * @return Response|mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $content = json_decode($response->content());

        if (isset($content->errors)) {
            return new Response(
                $response->content(),
                collect($content->errors)->first()->code
            );
        }

        return $response;
    }
}
