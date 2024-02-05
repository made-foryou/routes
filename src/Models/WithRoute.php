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
    protected static function bootWithRoute(): void
    {
        self::observe(WithRouteObserver::class);
    }

    /**
     * Gives access to the connected route model through the morph relation.
     */
    public function route(): MorphOne
    {
        return $this->morphOne(Route::class, 'routed');
    }
}
