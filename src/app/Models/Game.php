<?php

namespace App\Models;

use App\Models\Traits\AuditableTrait;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string gameDateTime
 * @property int playerOneMemberId
 * @property int playerOneScore
 * @property int playerTwoMemberId
 * @property int playerTwoScore
 */
class Game extends Model
{
    use HasFactory, AuditableTrait, HasTimestamps;

    protected $table = 'games';

    public $fillable = [
        'gameDateTime',
        'playerOneMemberId',
        'playerOneScore',
        'playerTwoMemberId',
        'playerTwoScore',
    ];

    /**
     * @return HasOne
     */
    public function playerOne(): HasOne
    {
        return $this->hasOne(Member::class, 'id', 'playerOneMemberId');
    }

    /**
     * @return HasOne
     */
    public function playerTwo(): HasOne
    {
        return $this->hasOne(Member::class, 'id', 'playerTwoMemberId');
    }
}
