@php use Carbon\Carbon; @endphp
@extends('templates.main')
@section('title', 'Member Details for '.$member->firstName.' '.$member->lastName)
@section('css')
    @parent
    #memberProfile {
        display: grid;
        grid-auto-flow: row;
        grid-gap: 20px;
        grid-template-columns: 300pt 300pt;
    }
    #recentGames fieldset table tbody tr:nth-child(odd) {
        background-color: #aaaaaa;
    }
    #recentGames fieldset table tbody td:nth-child(2) {
        text-align: center;
    }
@endsection
@section('content')
    <div id="memberProfile">
        <fieldset>
            <legend>First Name</legend>
            <span>{{ $member->firstName }}</span>
        </fieldset>
        <fieldset>
            <legend>Last Name</legend>
            <span>{{ $member->lastName }}</span>
        </fieldset>
        <fieldset>
            <legend>Date Joined</legend>
            <span>{{ $member->memberDetail->dateJoined }}</span>
        </fieldset>
        <fieldset>
            <legend>Email</legend>
            <span>{{ $member->memberDetail->email }}</span>
        </fieldset>
        <fieldset>
            <legend>Highest Score And Which Game</legend>
            <span>{{ $gameWithHighScore->scores->where('memberId', '=', $member->id)->first()->playerScore }} played on {{ \Carbon\Carbon::parse($gameWithHighScore->gameDateTime)->format('Y-m-d') }}</span>
        </fieldset>
        <fieldset>
            <legend>Average Member Score</legend>
            <span>{{ $averageMemberScore }}</span>
        </fieldset>
    </div>
    <div id="actions" class="marginTop20px">
        @include('partials.memberDetails.updateMemberDetailsLink', ['member'=>$member])
    </div>
    <div id="recentGames" class="marginTop20px">
        @if($recentGames->isEmpty())
            <b>No recent games for this player</b>
        @endif
        @foreach($recentGames as $game)
            <fieldset class="marginTop20px">
                <legend>{{ $game->gameDateTime }}</legend>
                <table>
                    <thead>
                    <tr>
                        <th>Player Name</th>
                        <th>Score</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($game->scores as $scores)
                        <tr>
                            <td>@include('partials.member.memberLink', ['member' => $scores->member])</td>
                            <td>{{ $scores->playerScore }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </fieldset>
        @endforeach
    </div>
@endsection
