<?php

namespace App\Http\Controllers;

use App\Http\Requests\Member\ShowMemberRequest;
use App\Repositories\GameRepository;
use App\Repositories\MemberRepository;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 *
 */
class MemberController extends Controller
{

    /**
     * @param RepositoryInterface|MemberRepository $memberRepository
     */
    public function __construct(
        private readonly RepositoryInterface $memberRepository,
    )
    {
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function list()
    {
        return \view('member.list', ['members' => $this->memberRepository->getAllMembers()]);
    }


    /**
     * @param ShowMemberRequest $request
     * @param GameRepository $gameRepository
     * @return Application|Factory|View
     */
    public function profile(
        ShowMemberRequest $request,
        GameRepository $gameRepository
    ): Application|View|Factory
    {
        // Method makes use of concrete binding as example of concrete dependency injection.
        $viewParams = [];

        // Load non-eager relationship
        $viewParams['member'] = $this->memberRepository->getMemberById($request->id, ['memberDetail']);

        $viewParams['gameWithHighScore'] = $gameRepository->gameWithHighScoreForMemberId($request->id);

        $viewParams['recentGames'] = $gameRepository->getRecentGamesForMemberId($request->id);

        $viewParams['averageMemberScore'] = \round($gameRepository->getAverageScoreForMemberId($request->id)??0);

        return \view('member.profile', $viewParams);
    }

    /**
     * @param ShowMemberRequest $request
     * @return Application|Factory|View
     */
    public function showUpdateMemberDetails(ShowMemberRequest $request): Application|Factory|View
    {
        // Load non-eager relationship
        $member = $this->memberRepository->getMemberById($request->id, ['memberDetail']);

        return \view('member.details.update', ['member' => $member]);
    }

}
