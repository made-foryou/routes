<?php

return [
    /**
     * The key in which the route data will be cached.
     *
     * @var string
     */
    'cache_key' => env('MADE_ROUTES_CACHE_KEY', 'made_routes'),

    /**
     * Connect routed_type classes to controller classes.
     *
     * These settings will be used for connecting the routes to the specified
     * controllers.
     *
     * @var array<class-string, class-string>
     */
    'controllers' => [
        // Define the type - controller settings.
    ],
];
