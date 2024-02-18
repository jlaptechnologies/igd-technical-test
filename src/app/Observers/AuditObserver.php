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
    public function created(Model $model): void
    {
        $this->createAudit($model, Audit::AUDIT_TYPE_CREATE);
    }

    /**
     * @param Model $model
     * @return void
     */
    public function updated(Model $model): void
    {
        $this->createAudit($model, Audit::AUDIT_TYPE_UPDATE);
    }

    /**
     * @param Model $model
     * @return void
     */
    public function deleted(Model $model): void
    {
        $this->createAudit($model, Audit::AUDIT_TYPE_DELETE);
    }

    /**
     * @param Model $model
     * @param string $auditType
     * @return void
     */
    private function createAudit(Model $model, string $auditType): void
    {
        try {
            Audit::create([
                'auditType' => $auditType,
                'before' => \json_encode($model->getOriginal(), \JSON_PRETTY_PRINT),
                'after' => \json_encode($model),
                'auditable_type' => \get_class($model),
                'auditable_id' => $model->{$model->getKeyName()},
            ]);

            // Clear the cache for scores to clear out aged data
            \cache()->forget(CacheKeysEnum::LEADERBOARD_SCORES->value);
        } catch (\Throwable $t) {
            \logger()->error($t->getMessage(), $t->getTrace());
        }
    }

}
