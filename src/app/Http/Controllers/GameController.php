<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Repositories\GameRepository;
use App\Repositories\RepositoryInterface;

class GameController extends Controller
{
    /**
     * @param RepositoryInterface|GameRepository $repository
     */
    public function __construct(
        private readonly RepositoryInterface $repository
    )
    {
    }

    public function create(CreateGameRequest $request)
    {

    }


    public function showGame(ShowGameRequest $request, Game $game)
    {

    }


    public function delete(DeleteGameRequest $request, Game $game)
    {

    }

    public function insert(InsertGameRequest $request)
    {

    }
}
