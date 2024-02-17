<?php

namespace App\Repositories;

use App\Enums\Cache\CacheKeysEnum;
use App\Models\Game;
use App\Models\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Traits\EnumeratesValues;

/**
 *
 */
class GameRepository implements RepositoryInterface
{
    /**
     * @return Builder
     */
    public function getLeaderBoardQuery(): Builder
    {
        // Raw query example
        return DB::connection('mysql')
            ->query()
            ->selectRaw(
                "gs.memberId, ROUND(AVG(gs.playerScore)) AS averageScore ".
                "FROM game_scores gs " .
                "WHERE gs.gameId NOT IN (SELECT g.id FROM games g WHERE g.deleted_at IS NOT NULL) " .
                "GROUP BY gs.memberId " .
                "ORDER BY averageScore DESC " .
                "LIMIT 10"
            );
    }


    /**
     * @param int $memberId
     * @return float|int|null
     */
    public function getAverageScoreForMemberId(int $memberId): float|int|null
    {
        // "programmatic" version of the raw select above (matches main leaderboard score)
        return Game::query()
            ->whereIn('id', function(Builder $query) use($memberId) {
                $query
                    ->select('game_scores.gameId')
                    ->from('game_scores')
                    ->where('game_scores.memberId', '=', $memberId);
            })
            ->with(['scores' => function($query) use($memberId) {
                $query->where('memberId', '=', $memberId);
            }])
            ->get()
            ->average(function(Game $game) use($memberId) {
                return $game->scores->firstWhere('memberId', '=', $memberId)->playerScore;
            });
    }

    /**
     * Returns a 30 minute cached list of the top ten average scores,
     * populating the member along with the average score
     * @return Collection|EnumeratesValues
     */
    public function getLeaderBoard(): EnumeratesValues|Collection
    {
        return \cache()
            ->remember(
                CacheKeysEnum::LEADERBOARD_SCORES->value,
                \DateInterval::createFromDateString('30 minute'),
                function(){
                    return $this
                        ->getLeaderBoardQuery()
                        ->get()
                        ->each(function(&$row) {
                            $row->member = Member::query()->find($row->memberId);
                        });
                }
            );
    }


    /**
     * @param int $memberId
     * @return Model|\Illuminate\Database\Eloquent\Builder|null
     */
    public function gameWithHighScoreForMemberId(int $memberId): Model|\Illuminate\Database\Eloquent\Builder|null
    {
        return Game::query()
            ->with(['scores','scores.member']) // load child relationship through child relationship
            ->where('id','=', function(Builder $query) use($memberId) {
                $query
                    ->select('gameId')
                    ->from('game_scores')
                    ->where('memberId', '=', $memberId)
                    ->orderBy('playerScore', 'DESC')
                    ->limit(1);
            })
            ->first();
    }

    /**
     * @param int $memberId
     * @return \Illuminate\Database\Eloquent\Collection|array
     */
    public function getRecentGamesForMemberId(int $memberId): \Illuminate\Database\Eloquent\Collection|array
    {
        return Game::query()
            ->with(['scores', 'scores.member'])
            ->whereIn('id', function(Builder $query) use($memberId) {
                $query
                    ->select('gameId')
                    ->from('game_scores')
                    ->where('memberId', '=', $memberId);
            })
            ->orderBy('gameDateTime', 'DESC')
            ->limit(10)
            ->get();
    }
}
