<?php

namespace MadeForYou\Routes;

use Filament\Contracts\Plugin;
use Filament\Panel;

class RoutesPlugin implements Plugin
{
    public static function make(): self
    {
        return app(static::class);
    }

    #[\Override]
    public function getId(): string
    {
        return RoutesServiceProvider::$name;
    }

    #[\Override]
    public function register(Panel $panel): void
    {
        $panel->resources([]);
    }

    #[\Override]
    public function boot(Panel $panel): void
    {
        // TODO: Implement boot() method.
    }
}
