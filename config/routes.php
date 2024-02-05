<?php

return [
    /**
     * The key in which the route data will be cached.
     *
     * @var string
     */
    'cache_key' => env('MADE_ROUTES_CACHE_KEY', 'made_routes'),

    /**
     * Default controller setting
     *
     * This action will be used when the system could not find any action rule
     * from the controllers option.
     *
     * @var class-string|callable|string|array<class-string, string>
     */
    'controller' => null,

    /**
     * Connect routed_type classes to controller classes.
     *
     * These settings will be used for connecting the routes to the specified
     * controllers.
     *
     * Examples:
     *  1. Post::class => PostController::class,
     *  2. Post::class .'-4' => SpecialPostController::class,
     *  3. Post::class => [PostController::class, 'post']
     *  4. Post::class => function (Route $route) {
     *      return PostController::class;
     *  }
     *
     * @var array<class-string|string, class-string|callable|string|array<class-string, string>>
     */
    'controllers' => [
        Post::class.'-2' => PostController::class,
    ],
];
