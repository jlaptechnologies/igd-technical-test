<?php

namespace App\Http\Controllers;

use App\Repositories\GameRepository;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ScoreboardController extends Controller
{

    public function __construct(
        private readonly RepositoryInterface $repository
    )
    {
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function showMainScoreBoard(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $viewParams = [
            'leaderBoardStats' => $this->repository->getLeaderBoard(),
        ];

        dd($viewParams);

        return \view('scoreboard.leaderboard', $viewParams);
    }

}
