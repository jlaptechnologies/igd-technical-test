<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowMemberRequest;
use App\Http\Requests\UpdateMemberDetailsRequest;
use App\Models\Member;

class MemberController extends Controller
{
    public function list()
    {
        return \view('member.list', ['members' => Member::all()]);
    }

    public function memberPage(ShowMemberRequest $request, Member $member)
    {

        $member->memberDetail();
    }

    public function updateMemberDetails(UpdateMemberDetailsRequest $request)
    {

    }

}
