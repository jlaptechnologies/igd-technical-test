<?php

namespace App\Repositories;

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
        return DB::connection('mysql')
            ->query()
            ->selectRaw(
                "gs.memberId, ROUND(AVG(gs.playerScore)) AS averageScore ".
                "FROM game_scores gs " .
                "GROUP BY gs.memberId " .
                "ORDER BY averageScore DESC " .
                "LIMIT 10"
            );
    }

    /**
     * @return Collection|EnumeratesValues
     */
    public function getLeaderBoard(): EnumeratesValues|Collection
    {
        return $this
            ->getLeaderBoardQuery()
            ->get()
            ->each(function(&$row) {
                $row->member = Member::query()->find($row->memberId);
            });
    }
}
