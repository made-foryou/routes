<?php

namespace MadeForYou\Routes\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property-read int $id
 *
 * @mixin Model
 */
interface HasRoute
{
    /**
     * Gives access to the connected route model through the morph relation.
     *
     * @return MorphOne
     */
    public function route(): MorphOne;

    /**
     * Builds the url for the model. This value will be saved within the
     * url column and will be used as "route" when registering the
     * routes.
     *
     * @return string
     */
    public function getUrl(): string;
}
