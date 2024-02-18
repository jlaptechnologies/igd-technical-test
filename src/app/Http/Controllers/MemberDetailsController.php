<?php

namespace App\Http\Controllers;

use App\Http\Requests\Member\UpdateMemberDetailsRequest;
use App\Repositories\MemberRepository;
use App\Repositories\RepositoryInterface;
use Illuminate\Support\MessageBag;

class MemberDetailsController extends Controller
{
    /**
     * @param RepositoryInterface|MemberRepository $repository
     */
    public function __construct(
        private readonly RepositoryInterface $repository
    )
    {}


    /**
     * @param UpdateMemberDetailsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateMemberDetails(UpdateMemberDetailsRequest $request)
    {
        try {
            $member = $this
                ->repository
                ->getMemberById($request->memberId, ['memberDetail']);

            $member->memberDetail->update([
                'email' => $request->email,
            ]);

            $response = \redirect()
                ->route('member.profile', ['id' => $member->id]);
        } catch (\Throwable $t) {
            \logger()->error($t->getMessage(), $t->getTrace());

            $response = \redirect()
                ->route('member.profile', ['id' => $member->id])
                ->with(['errors'=>(new MessageBag(['Updating member details failed. Please check logs for details.']))]);
        } finally {
            return $response;
        }
    }
}
