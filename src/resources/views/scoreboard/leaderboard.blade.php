@extends('templates.main')
@section('title', 'ScrabbleFriends Group Main Page')
@section('css')
    @parent
    #highScoresTable {
        outline: black 1px solid;
    }
    #highScoresTable > td .grey {
        background-color: #aaaaaa;
    }
@endsection
@section('content')
    @if(empty($leaderBoardStats))
        <div>
            <b>Currently no data exist in the database regarding members or games played.</b>
        </div>
    @endif
    <table id="highScoresTable">
        <tr>
            <th>Player Name</th>
            <th>Average All Time Score</th>
        </tr>
        @foreach($leaderBoardStats as $idx => $leaderBoardStat)
            <tr @if($idx % 2 === 0)class="grey"@endif>
                <td>{{ $leaderBoardStat->member->firstName.' '.$leaderBoardStat->member->lastName }}</td>
                <td>{{ $leaderBoardStat->averageScore }}</td>
            </tr>
        @endforeach
    </table>
@endsection
