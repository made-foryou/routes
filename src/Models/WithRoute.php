<?php

namespace MadeForYou\Routes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use MadeForYou\Routes\Observers\WithRouteObserver;

/**
 * @mixin Model
 */
trait WithRoute
{
    /**
     * User exposed observable events.
     *
     * These are extra user-defined events observers may subscribe to.
     */
    protected array $observables = [
        WithRouteObserver::class,
    ];

    /**
     * Gives access to the connected route model through the morph relation.
     */
    public function route(): MorphOne
    {
        return $this->morphOne(Route::class, 'routed');
    }
}
