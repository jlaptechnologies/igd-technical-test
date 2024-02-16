<?php

namespace App\Models;

use App\Models\Traits\AuditableTrait;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string gameDateTime
 * @property int playerMemberId
 * @property int playerScore
 */
class Game extends Model
{
    use HasFactory, AuditableTrait, HasTimestamps, SoftDeletes;

    protected $table = 'games';

    public $fillable = [
        'gameDateTime',
        'playerMemberId',
        'playerScore',
    ];

    /**
     * @return HasMany
     */
    public function scores(): HasMany
    {
        return $this->hasMany(GameScore::class, 'gameId', 'id');
    }
}
