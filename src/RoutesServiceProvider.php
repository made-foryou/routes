<?php

namespace MadeForYou\Routes;

use MadeForYou\Routes\Facades\Routing;
use MadeForYou\Routes\Models\Route;
use MadeForYou\Routes\Observers\RouteObserver;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class RoutesServiceProvider extends PackageServiceProvider
{
    public static string $name = 'routes';

    public static string $repository = 'made-foryou/routes';

    /**
     * @var array|string[]
     */
    public static array $migrations = [
        'create_routes_table',
    ];

    /**
     * Configures everything about the package.
     */
    #[\Override]
    public function configurePackage(Package $package): void
    {
        $package->name(self::$name)
            ->hasConfigFile()
            ->hasMigrations(self::$migrations)
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->askToStarRepoOnGitHub(self::$repository);
            });
    }

    /**
     * Registers objects and classes onto the container.
     */
    public function registeringPackage(): void
    {
        $this->app->register(Routing::$accessor, function () {
            return new \MadeForYou\Routes\Helpers\Routing();
        });
    }

    /**
     * Boots the package.
     */
    public function bootingPackage(): void
    {
        Route::observe(RouteObserver::class);
    }
}
