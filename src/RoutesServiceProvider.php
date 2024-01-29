<?php

namespace MadeForYou\Routes;

use MadeForYou\Routes\Models\Route;
use MadeForYou\Routes\Facades\Routing;
use Spatie\LaravelPackageTools\Package;
use MadeForYou\Routes\Observers\RouteObserver;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\LaravelPackageTools\Commands\InstallCommand;

class RoutesServiceProvider extends PackageServiceProvider
{
    /**
     * @var string
     */
    public static string $name = 'routes';

    /**
     * @var string
     */
    public static string $repository = 'made-foryou/routes';

    /**
     * @var array|string[]
     */
    public static array $migrations = [
        'create_routes_table'
    ];

    /**
     * Configures everything about the package.
     *
     * @param  Package  $package
     *
     * @return void
     */
    #[\Override] public function configurePackage(Package $package): void
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
     *
     * @return void
     */
    public function registeringPackage(): void
    {
        $this->app->register(Routing::$accessor, function () {
            return new \MadeForYou\Routes\Helpers\Routing();
        });
    }

    /**
     * Boots the package.
     *
     * @return void
     */
    public function bootingPackage(): void
    {
        Route::observe(RouteObserver::class);
    }
}
