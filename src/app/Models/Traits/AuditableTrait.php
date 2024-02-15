<?php

namespace App\Models\Traits;

use App\Models\Audit;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait AuditableTrait
{
    public function audit(): MorphOne
    {
        return $this->morphOne(Audit::class, 'auditable');
    }
}
