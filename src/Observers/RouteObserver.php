<?php

namespace MadeForYou\Routes\Observers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use MadeForYou\Routes\Actions\RefreshRouteCacheAction;
use MadeForYou\Routes\Models\Route;

class RouteObserver
{
    /**
     * @throws BindingResolutionException
     */
    public function saved(Route $route): void
    {
        RefreshRouteCacheAction::run();
    }
}
