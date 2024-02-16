<?php

namespace App\Observers;

use App\Models\Audit;
use App\Enums\Cache\CacheKeysEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class AuditObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * @param Model $model
     * @return void
     */
    public function created(Model $model)
    {
        try {
            Audit::create([
                'auditType' => Audit::AUDIT_TYPE_CREATE,
                'before' => \json_encode($model->getOriginal(), \JSON_PRETTY_PRINT),
                'after' => \json_encode($model),
                'auditable_type' => \get_class($model),
                'auditable_id' => $model->{$model->getKeyName()},
            ]);

            // On create, clear the cache for scores to clear out aged data
            \cache()->forget(CacheKeysEnum::LEADERBOARD_SCORES->value);
        } catch (\Throwable $t) {
            \logger()->error($t->getMessage(), $t->getTrace());
        }
    }

    /**
     * @param Model $model
     * @return void
     */
    public function updated(Model $model)
    {
        try {
            Audit::create([
                'auditType' => Audit::AUDIT_TYPE_UPDATE,
                'before' => \json_encode($model->getOriginal(), \JSON_PRETTY_PRINT),
                'after' => \json_encode($model),
                'auditable_type' => \get_class($model),
                'auditable_id' => $model->{$model->getKeyName()},
            ]);

            // On update, clear the cache for scores to clear out aged data
            \cache()->forget(CacheKeysEnum::LEADERBOARD_SCORES->value);
        } catch (\Throwable $t) {
            \logger()->error($t->getMessage(), $t->getTrace());
        }
    }

}
