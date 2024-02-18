<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Game\CreateGameRequest;
use App\Http\Requests\Game\DeleteGameRequest;
use App\Http\Requests\Game\ShowGameRequest;
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

    public function create()
    {

    }


    public function showGame(ShowGameRequest $request, Game $game)
    {

    }


    public function delete(DeleteGameRequest $request, Game $game)
    {

    }

    public function insert(CreateGameRequest $request)
    {

    }
}
