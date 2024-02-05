<?php

namespace MadeForYou\Routes\Helpers;

use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use MadeForYou\Routes\Models\Route;
use Illuminate\Support\Facades\Route as RouteFacade;

class Routing
{
    /**
     * @throws Exception
     */
    public function routes(): void
    {
        if (! Cache::has($this->routesCacheKey())) {
            throw new Exception(
                'There is no cache with key name '
                    .$this->routesCacheKey().' available.'
            );
        }

        $routes = collect(Cache::get($this->routesCacheKey()));

        $routes->each(function (Route $route) {
            RouteFacade::get(
                $route->routed->getUrl(),
                $this->getRouteAction($route)
            )->name($this->getRouteName($route));
        });
    }

    public function getRouteAction(Route $route): mixed
    {
        $action = $this->getSpecificSetting($route);

        if ($action === null) {
            $action = $this->getTypeDefinedSetting($route);
        }

        if ($action === null) {
            $action = $this->getGlobalSetting();
        }

        if (is_callable($action)) {
            $action = $action($route);
        }

        return $action;
    }

    public function getSpecificSetting(Route $route): mixed
    {
        return $this->routeActionSettings()->get(
            $route->routed_type.'-'.$route->routed_id
        );
    }

    public function getTypeDefinedSetting(Route $route): mixed
    {
        return $this->routeActionSettings()->get($route->routed_type);
    }

    public function getGlobalSetting(): mixed
    {
        return config('routes.controller');
    }

    protected function routesCacheKey(): string
    {
        return Config::get('routes.cache_key');
    }

    protected function routeActionSettings(): Collection
    {
        return collect(config('routes.controllers'));
    }

    protected function getRouteName(Route $route): string
    {
        $name = $route->routed->getRouteName();

        return $name ?? $route->routed_type.'.'.$route->routed_id;
    }
}
