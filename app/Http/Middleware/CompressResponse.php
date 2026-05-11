<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompressResponse
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (!function_exists('gzencode')) {
            return $response;
        }

        $accept = $request->header('Accept-Encoding', '');
        if (stripos($accept, 'gzip') === false) {
            return $response;
        }

        if (!$response instanceof Response) {
            return $response;
        }

        if ($response->headers->has('Content-Encoding')) {
            return $response;
        }

        $contentType = (string) $response->headers->get('Content-Type', '');
        $compressible = preg_match('#^(text/|application/(json|javascript|xml|xhtml\+xml|rss\+xml))#i', $contentType);
        if (!$compressible) {
            return $response;
        }

        $content = $response->getContent();
        if ($content === false || strlen($content) < 1024) {
            return $response;
        }

        $compressed = gzencode($content, 6);
        if ($compressed === false) {
            return $response;
        }

        $response->setContent($compressed);
        $response->headers->set('Content-Encoding', 'gzip');
        $response->headers->set('Content-Length', strlen($compressed));
        $response->headers->set('Vary', 'Accept-Encoding');

        return $response;
    }
}
