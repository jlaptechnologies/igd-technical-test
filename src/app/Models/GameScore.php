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

    public $primaryKey = 'id';

    public $fillable = [
        'gameId',
        'memberId',
        'score',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class, 'gameId', 'id');
    }

    public function member()
    {

    }
}
