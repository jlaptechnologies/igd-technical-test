@extends('templates.main')
@section('title', 'All Games')
@section('css')
    @parent
    #gameTable {
        outline: black 1px solid;
    }
    #gameTable tbody tr.grey {
        background-color: #aaaaaa;
    }
    #gameTable tbody tr td:nth-child(2) {
        text-align: center;
    }
@endsection
@section('content')
    @if(empty($games))
        <div>
            <b>Currently no data exist in the database regarding games.</b>
        </div>
    @endif
    <table id="gameTable">
        <thead>
            <tr>
                <th>Gate Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($games as $idx => $game)
            <tr @if($idx % 2 === 0)class="grey"@endif>
                <td>
                    {{ $game->gameDateTime }}
                </td>
                <td>
                    @include('partials.game.gameLink', ['game'=>$game])
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

