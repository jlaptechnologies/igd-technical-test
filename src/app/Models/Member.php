<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string $firstName
 * @property string $lastName
 * @property MemberDetail $memberDetail
 */
class Member extends Model
{
    use HasFactory, HasTimestamps;

    /**
     * @var string $table
     */
    protected $table = 'members';

    /**
     * @return HasOne
     */
    public function memberDetail(): HasOne
    {
        return $this->hasOne(MemberDetail::class, 'member_id', 'id');
    }
}
