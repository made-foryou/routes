<?php
declare( strict_types = 1 );

namespace MadeForYou\Routes\Actions;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use MadeForYou\Routes\Models\Route;

class RefreshRouteCacheAction
{
    /**
     * Get the cache key for the routes cache.
     *
     * @return string The cache key for the routes cache.
     */
    protected function cacheKey(): string
    {
        return Config::get('routes.cache_key');
    }

    /**
     * Execute the action to refresh the route cache.
     *
     * @return void
     */
    public function execute (): void
    {
        Cache::forget($this->cacheKey());

        Cache::rememberForever($this->cacheKey(), function () {
            return Route::all();
        });
    }

    /**
     * Run the refresh route cache action.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public static function run (): void
    {
        app()->make(RefreshRouteCacheAction::class)
            ->execute(...func_get_args());
    }
}
