<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowMemberRequest;
use App\Http\Requests\UpdateMemberDetailsRequest;
use App\Models\Member;
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
     * @param RepositoryInterface|MemberRepository $repository
     */
    public function __construct(
        private readonly RepositoryInterface $repository
    )
    {
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function list()
    {
        return \view('member.list', ['members' => $this->repository->getAllMembers()]);
    }


    /**
     * @param ShowMemberRequest $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function profile(ShowMemberRequest $request)
    {
        // Load non-eager relationship
        $member = $this->repository->getMemberById($request->id, ['memberDetail']);

        return \view('member.profile', ['member' => $member]);
    }

    /**
     * @param ShowMemberRequest $request
     * @param Member $member
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function showUpdateMemberDetails(ShowMemberRequest $request, Member $member)
    {
        // Load non-eager relationship
        $member = $this->repository->getMemberById($request->id, ['memberDetail']);

        return \view('member.details.update', ['member' => $member]);
    }

}
