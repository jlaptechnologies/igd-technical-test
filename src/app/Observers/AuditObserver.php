<?php

namespace App\Observers;

use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Database\Eloquent\Model;

class AuditObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * @param Model $model
     * @return void
     */
    public function created(Model $model)
    {

    }

    /**
     * @param Model $model
     * @return void
     */
    public function updated(Model $model)
    {

    }

}
