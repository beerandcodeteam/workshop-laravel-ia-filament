<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StreamingMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        // Se for uma resposta de streaming, configurar headers apropriados
        if ($response instanceof \Symfony\Component\HttpFoundation\StreamedResponse) {
            $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', '0');
            $response->headers->set('X-Accel-Buffering', 'no');
        }
        
        return $response;
    }
}
