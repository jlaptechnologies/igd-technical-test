<?php

namespace App\Repositories;

use App\Enums\Cache\CacheKeysEnum;
use App\Models\Member;
use App\Repositories\RepositoryInterface;
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
}
