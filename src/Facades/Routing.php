<?php

namespace MadeForYou\Routes\Facades;

use Illuminate\Support\Facades\Facade;

class Routing extends Facade
{
    public static string $accessor = 'made-routing';

    protected static function getFacadeAccessor(): string
    {
        return self::$accessor;
    }
}
