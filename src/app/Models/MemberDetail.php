<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $email
 * @property Member $member
 */
class MemberDetail extends Model
{
    use HasFactory, HasTimestamps;

    protected $table = 'member_details';

    public $fillable = [
        'member_id',
        'email',
    ];

    /**
     * @return BelongsTo
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo('member', 'member_id', 'id');
    }
}
