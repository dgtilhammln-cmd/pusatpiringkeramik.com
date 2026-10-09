<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;

class OptimizeResponseMiddleware
{
    /**
     * Handle an incoming request.
     * Optimize HTML response: inject lazy loading, rewrite webp images, add caching headers, minify output.
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        $contentType = $response->headers->get('Content-Type', '');
        
        // Add performance headers for text/html responses
        if (str_contains($contentType, 'text/html') && $response->getStatusCode() === 200) {
            $content = $response->getContent();

            if ($content) {
                // 1. Auto-inject loading="lazy" decoding="async" for <img> elements missing loading attribute
                $content = $this->injectLazyLoading($content);

                // 2. Auto-rewrite /storage/*.jpg|png to .webp if .webp file exists on disk
                $content = $this->rewriteWebpImages($content);

                // 3. Minify HTML
                $content = $this->minifyHtml($content);

                $response->setContent($content);
            }

            // HTTP Caching & Speed Headers
            if (!$request->is('admin*') && $request->isMethod('GET')) {
                $response->headers->set('Cache-Control', 'public, max-age=1800, s-maxage=3600, must-revalidate');
                $response->headers->set('Vary', 'Accept-Encoding, User-Agent');
                $etag = md5($response->getContent());
                $response->headers->set('ETag', '"' . $etag . '"');
            } else {
                $response->headers->set('Cache-Control', 'no-cache, private');
            }

            $response->headers->set('X-Content-Type-Options', 'nosniff');
        }

        return $response;
    }

    /**
     * Auto inject loading="lazy" and decoding="async" to <img> tags without loading attribute.
     */
    private function injectLazyLoading(string $html): string
    {
        return preg_replace_callback(
            '/<img\b(?![^>]*\bloading=)([^>]*)\/?>/i',
            function ($m) {
                $attributes = $m[1];
                return '<img loading="lazy" decoding="async" ' . trim($attributes) . '>';
            },
            $html
        );
    }

    /**
     * Rewrite /storage/.../file.png|jpg to .webp if the .webp file exists in storage.
     */
    private function rewriteWebpImages(string $html): string
    {
        return preg_replace_callback(
            '/src=["\']([^"\']+\/storage\/([^"\']+\.(?:png|jpg|jpeg)))["\']/i',
            function ($m) {
                $fullUrl = $m[1];
                $relativePath = $m[2];
                $webpPath = preg_replace('/\.(png|jpg|jpeg)$/i', '.webp', $relativePath);

                if (Storage::disk('public')->exists($webpPath)) {
                    $webpUrl = str_replace($relativePath, $webpPath, $fullUrl);
                    return 'src="' . $webpUrl . '"';
                }

                return $m[0];
            },
            $html
        );
    }

    /**
     * Minify HTML output safely.
     */
    private function minifyHtml(string $html): string
    {
        $placeholders = [];
        $i = 0;

        // Protect <pre>
        $html = preg_replace_callback('/<pre\b[^>]*>.*?<\/pre>/is', function ($m) use (&$placeholders, &$i) {
            $key = "%%PROTECTED_{$i}%%";
            $placeholders[$key] = $m[0];
            $i++;
            return $key;
        }, $html);

        // Protect <script>
        $html = preg_replace_callback('/<script\b[^>]*>.*?<\/script>/is', function ($m) use (&$placeholders, &$i) {
            $key = "%%PROTECTED_{$i}%%";
            $placeholders[$key] = $m[0];
            $i++;
            return $key;
        }, $html);

        // Protect <style>
        $html = preg_replace_callback('/<style\b[^>]*>.*?<\/style>/is', function ($m) use (&$placeholders, &$i) {
            $key = "%%PROTECTED_{$i}%%";
            $placeholders[$key] = $m[0];
            $i++;
            return $key;
        }, $html);

        // Protect <textarea>
        $html = preg_replace_callback('/<textarea\b[^>]*>.*?<\/textarea>/is', function ($m) use (&$placeholders, &$i) {
            $key = "%%PROTECTED_{$i}%%";
            $placeholders[$key] = $m[0];
            $i++;
            return $key;
        }, $html);

        // Remove HTML comments (except conditional ones)
        $html = preg_replace('/<!--(?!\[if).*?-->/s', '', $html);

        // Compress whitespace between HTML tags
        $html = preg_replace('/\s{2,}/s', ' ', $html);
        $html = preg_replace('/>\s+</s', '><', $html);

        // Restore protected tags
        if (!empty($placeholders)) {
            $html = str_replace(array_keys($placeholders), array_values($placeholders), $html);
        }

        return trim($html);
    }
}
