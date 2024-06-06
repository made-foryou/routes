<?php

namespace MadeForYou\Routes\Observers;

use Illuminate\Contracts\Container\BindingResolutionException;
use MadeForYou\Routes\Actions\RefreshRouteCacheAction;
use MadeForYou\Routes\Contracts\HasRoute;

class WithRouteObserver
{
    /**
     * Triggered when a new model is created.
     *
     * @param  HasRoute  $model  The newly created model.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function created(HasRoute $model): void
    {
        $this->saveRoute($model);
    }

    /**
     * Invoked after a model has been updated.
     *
     * @param  HasRoute  $model  The model that has been updated.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function updated(HasRoute $model): void
    {
        $this->saveRoute($model);
    }

    /**
     * Handles the "deleted" event for the given model.
     *
     * @param  HasRoute  $model  The model that was deleted.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function deleted(HasRoute $model): void
    {
        $this->saveRoute($model);
    }

    /**
     * Saves the route for the given model.
     *
     * @param  HasRoute  $model  The model for which the route needs to be saved.
     *
     * @return void
     * @throws BindingResolutionException
     */
    protected function saveRoute(HasRoute $model): void
    {
        $model->route()->updateOrCreate([
            'routed_type' => $model::class,
            'routed_id' => $model->id,
        ], [
            'url' => $model->getUrl(),
        ]);

        RefreshRouteCacheAction::run();
    }
}
