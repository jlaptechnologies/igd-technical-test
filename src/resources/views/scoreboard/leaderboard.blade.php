@extends('templates.main')
@section('title', 'ScrabbleFriends Group Main Page')
@section('css')
    @parent
    #highScoresTable {
    outline: black 1px solid;
    }
    #highScoresTable tbody tr.grey {
    background-color: #aaaaaa;
    }
    #highScoresTable tbody tr td:nth-child(2) {
    text-align: center;
    }
@endsection
@section('content')
{{--    @dd($leaderBoardStats)--}}
    @if($leaderBoardStats->isEmpty())
        <div>
            <b>Currently no data exist in the database regarding members or games played.</b>
        </div>
    @endif
    <table id="highScoresTable">
        <thead>
        <tr>
            <th>Player Name</th>
            <th>Average All Time Score</th>
        </tr>
        </thead>
        <tbody>
        @if($leaderBoardStats->isNotEmpty())
        @foreach($leaderBoardStats as $idx => $leaderBoardStat)
            <tr @if($idx % 2 === 0)class="grey"@endif>
                <td>@include('partials.member.memberLink',['member'=>$leaderBoardStat->member])</td>
                <td>{{ $leaderBoardStat->averageScore }}</td>
            </tr>
        @endforeach
        @endif
        </tbody>
    </table>
@endsection
