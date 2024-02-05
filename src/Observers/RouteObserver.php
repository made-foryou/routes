<?php

namespace MadeForYou\Routes\Observers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use MadeForYou\Routes\Models\Route;

class RouteObserver
{
    public function saved(Route $route): void
    {
        Cache::forget(self::cacheKey());

        dump('saving the cache into', self::cacheKey());
        dump(Route::all());

        Cache::rememberForever(self::cacheKey(), function () {
            return Route::all();
        });
    }

    public static function cacheKey(): string
    {
        return Config::get('routes.cache_key');
    }
}
