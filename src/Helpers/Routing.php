<?php

namespace MadeForYou\Routes\Helpers;

use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class Routing
{
    /**
     * @throws Exception
     */
    public function routes()
    {
        if (! Cache::has($this->routesCacheKey())) {
            throw new Exception('There is no cache with key name '. $this->routesCacheKey() . ' available.');
        }

        $routes = Cache::get($this->routesCacheKey());

        dd($routes);
    }

    public function routesCacheKey(): string
    {
        return Config::get('routes.cache_key');
    }
}
