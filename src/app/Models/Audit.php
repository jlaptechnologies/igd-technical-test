<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string $auditType
 * @property string $before
 * @property string $after
 * @property int $auditable_id
 * @property string $auditable_type
 */
class Audit extends Model
{
    use HasTimestamps;

    const AUDIT_TYPE_CREATE = 'created';
    const AUDIT_TYPE_UPDATE = 'updated';

    /**
     * @var string
     */
    protected $table = 'audits';

    /**
     * @var string[]
     */
    protected $fillable = [
        'auditType',
        'before',
        'after',
        'auditable_id',
        'auditable_type',
    ];

    /**
     * @return MorphTo
     */
    public function auditable(): MorphTo
    {
        return $this->morphTo();
    }
}
