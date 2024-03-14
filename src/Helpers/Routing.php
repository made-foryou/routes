<?php

namespace MadeForYou\Routes\Helpers;

use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route as RouteFacade;
use MadeForYou\Routes\Models\Route;

class Routing
{
    /**
     * Generates the routes according this route package.
     *
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

        $this->getRoutes()->each(function (Route $route) {
            RouteFacade::get(
                $route->routed->getUrl(),
                $this->getRouteAction($route)
            )->name($this->getRouteName($route));
        });
    }

    /**
     * Checks whether the route name is generated from this Routing class.
     *
     * @param  string  $name
     *
     * @return bool
     */
    public function hasRoute(string $name): bool
    {
        return $this->getRoute($name) !== null;
    }

    /**
     * Returns the route from the given route name.
     *
     * @param  string  $name
     *
     * @return Route|null
     */
    public function getRoute(string $name): ?Route
    {
        return $this->getRoutes()
            ->filter(fn (Route $route) => $route->routed->getRouteName() === $name)
            ->first();
    }

	/**
	 * Gathers the routes from the cache file.
	 *
	 * @return Collection
	 */
    protected function getRoutes(): Collection
    {
        return collect(Cache::get($this->routesCacheKey(), []));
    }

    protected function getRouteAction(Route $route): mixed
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

    protected function getSpecificSetting(Route $route): mixed
    {
        return $this->routeActionSettings()->get(
            $route->routed_type.'-'.$route->routed_id
        );
    }

    protected function getTypeDefinedSetting(Route $route): mixed
    {
        return $this->routeActionSettings()->get($route->routed_type);
    }

    protected function getGlobalSetting(): mixed
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
