<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LanguageMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasHeader('Accept-Language')) {
            $preferredLanguage = $request->getPreferredLanguage();
            $preferredLanguage = $this->formatLanguage($preferredLanguage);

            app()->setLocale(
                $preferredLanguage
            );
        }

        return $next($request);
    }

    public function formatLanguage(string $language): string
    {
        $position = strpos($language, '_');

        if (! $position) {
            return $language;
        }

        return substr($language, 0, $position);
    }
}
