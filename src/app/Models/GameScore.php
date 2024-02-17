<?php

namespace App\Models;

use App\Models\Traits\AuditableTrait;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $gameId
 * @property int $playerMemberId
 * @property int $score
 */
class GameScore extends Model
{
    use HasFactory, HasTimestamps, AuditableTrait;

    /**
     * @var string
     */
    public $primaryKey = 'id';

    /**
     * @var string[]
     */
    public $fillable = [
        'gameId',
        'memberId',
        'score',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game()
    {
        return $this->belongsTo(Game::class, 'gameId', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function member()
    {
        return $this->hasOne(Member::class, 'id', 'memberId');
    }
}
