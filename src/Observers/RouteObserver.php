<?php

namespace MadeForYou\Routes\Observers;

use MadeForYou\Routes\Models\Route;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class RouteObserver
{
    public function saved(Route $route): void
    {
        Cache::forget(self::cacheKey());
        Cache::forever(self::cacheKey(), function () {
            return Route::all();
        });
    }

    public static function cacheKey(): string
    {
        return Config::get('routes.cache_key');
    }
}
