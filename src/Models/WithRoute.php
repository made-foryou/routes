<?php

namespace MadeForYou\Routes\Models;

use Illuminate\Database\Eloquent\Model;
use MadeForYou\Routes\Observers\WithRouteObserver;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @mixin Model
 */
trait WithRoute
{
    /**
     * User exposed observable events.
     *
     * These are extra user-defined events observers may subscribe to.
     *
     * @var array
     */
    protected $observables = [
        WithRouteObserver::class,
    ];

    /**
     * Gives access to the connected route model through the morph relation.
     *
     * @return MorphOne
     */
    public function route(): MorphOne
    {
        return $this->morphOne(Route::class, 'routed');
    }
}
