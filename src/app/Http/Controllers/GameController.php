<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Game\CreateGameRequest;
use App\Http\Requests\Game\DeleteGameRequest;
use App\Http\Requests\Game\ShowGameRequest;
use App\Models\Game;
use App\Models\GameScore;
use App\Repositories\GameRepository;
use App\Repositories\GameScoreRepository;
use App\Repositories\MemberRepository;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class GameController extends Controller
{
    /**
     * @param RepositoryInterface&GameRepository $repository
     */
    public function __construct(
        private readonly RepositoryInterface $repository
    )
    {
    }

    /**
     * @return ApplicationContract|Factory|View|Application
     */
    public function list(): Application|View|Factory|ApplicationContract
    {
        return \view('game.list', ['games' => $this->repository->getAllGames()]);
    }

    /**
     * @param MemberRepository $memberRepository
     * @return View|Application|Factory|ApplicationContract
     */
    public function create(MemberRepository $memberRepository): View|Application|Factory|ApplicationContract
    {
        return \view('game.create', ['members' => $memberRepository->getAllMembers()]);
    }


    /**
     * @param ShowGameRequest $request
     * @return View|Application|Factory|ApplicationContract
     */
    public function showGame(ShowGameRequest $request): View|Application|Factory|ApplicationContract
    {
        return \view('game.showGame', ['game' => $this->repository->getGameById($request->id, ['scores','scores.member'])]);
    }


    /**
     * @param DeleteGameRequest $request
     * @return RedirectResponse
     */
    public function delete(DeleteGameRequest $request): RedirectResponse
    {
        $this->repository->getGameById($request->gameId)->delete();

        return \redirect()->route('game.list');
    }

    /**
     * @param CreateGameRequest $request
     * @param GameScoreRepository $gameScoreRepository
     * @return RedirectResponse
     */
    public function insert(CreateGameRequest $request, GameScoreRepository $gameScoreRepository): RedirectResponse
    {
        $game = $this->repository->createGame([
            'gameDateTime' => $request->gameDateTime,
        ]);

        $gameScoreRepository->createGameScores($game->id, $request->player);

        $game->save();

        return \redirect()->route('game.list');
    }
}
