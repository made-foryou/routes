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
     */
    public function route(): MorphOne;

    /**
     * Builds the url for the model. This value will be saved within the
     * url column and will be used as "route" when registering the
     * routes.
     */
    public function getUrl(): string;

    /**
     * Gives the route name which can be used to fast-link routes according
     * to their names.
     */
    public function getRouteName(): string;

    public function getTitle(): string;

    public function getType(): string;
}
