<?php

namespace MadeForYou\Routes\Facades;

use MadeForYou\Routes\Models\Route;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void routes()
 * @method static Route|null getRoute(string $name)
 * @method static bool hasRoute(string $name)
 */
class Routing extends Facade
{
    public static string $accessor = 'made-routing';

    protected static function getFacadeAccessor(): string
    {
        return self::$accessor;
    }
}
