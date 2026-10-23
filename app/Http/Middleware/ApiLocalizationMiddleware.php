<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class ApiLocalizationMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next) {
        $localization = $this->normalizeLocale($request->header('Content-Language'));

        if (empty($localization)) {
            try {
                if (Schema::hasTable('settings')) {
                    $localization = $this->normalizeLocale(
                        Cache::rememberForever('global_default_language', function () {
                            return Setting::where('name', 'default_language')->value('value') ?? 'en';
                        })
                    );
                }
            } catch (\Exception $e) {
                $localization = null;
            }
        }

        // A locale that is not a real code makes Symfony's translator throw
        // ("Invalid \"https:\" locale") and turns the API into a 500. The header
        // is client input, so anything else falls back to the app default.
        app()->setLocale($localization ?? config('app.locale', 'en'));

        return $next($request);
    }

    /**
     * Accepts "en", "ar-EG", "en_US" … and rejects everything else (URLs,
     * percent-encoded junk, empty strings).
     */
    private function normalizeLocale(mixed $value): ?string
    {
        if (! is_string($value)) {
            return null;
        }

        $value = trim($value);

        return preg_match('/^[a-z]{2,3}([_-][a-z0-9]{2,8})*$/i', $value) ? $value : null;
    }
}
