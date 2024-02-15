<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 *
 */
class Audit extends Model
{
    use HasTimestamps;

    /**
     *
     */
    const AuditType = [
        'create',
        'update'
    ];

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
        'after'
    ];

    /**
     * @return MorphTo
     */
    public function auditable(): MorphTo
    {
        return $this->morphTo();
    }
}
