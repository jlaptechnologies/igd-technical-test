<?php

namespace App\Repositories;

use App\Models\GameScore;
use App\Repositories\RepositoryInterface;

class GameScoreRepository implements RepositoryInterface
{
    /**
     * @param int $gameId
     * @param array $gameScores
     * @return array
     */
    public function createGameScores(int $gameId, array $gameScores): array
    {
        $newGameScores = [];

        foreach ( $gameScores as $gameScore ) {
            $newGameScores[] = GameScore::factory()->createOne(
                \array_merge(['gameId' => $gameId], $gameScore)
            );
        }

        return $newGameScores;
    }
}
