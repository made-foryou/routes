<?php

namespace MadeForYou\Routes\Observers;

use MadeForYou\Routes\Contracts\HasRoute;

class WithRouteObserver
{
    public function created(HasRoute $model): void
    {
        $this->saveRoute($model);
    }

    public function updated(HasRoute $model): void
    {
        $this->saveRoute($model);
    }

    public function deleted(HasRoute $model): void
    {
        $this->saveRoute($model);
    }

    protected function saveRoute(HasRoute $model): void
    {
        $model->route()->updateOrCreate([
            'routed_type' => $model::class,
            'routed_id' => $model->id,
        ], [
            'url' => $model->getUrl(),
        ]);
    }
}
