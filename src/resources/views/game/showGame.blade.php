@php use Carbon\Carbon; @endphp
@extends('templates.main')
@section('title', 'Game Details for game '.$game->id.' played on '.Carbon::parse($game->gameDateTime)->format('Y-m-d'))
@section('css')
    @parent
    #gameDetails {
        display: grid;
        grid-auto-flow: row;
        grid-gap: 20px;
        grid-template-columns: 300pt 300pt;
    }
    #playerScores fieldset table tbody {
        background-color: #aaaaaa;
    }
    #recentGames fieldset table tbody td:nth-child(2) {
        text-align: center;
    }
@endsection
@section('content')
    <div id="gameDetails">
        <fieldset>
            <legend>Game ID</legend>
            <span>{{ $game->id }}</span>
        </fieldset>
        <fieldset>
            <legend>Date / Time Played</legend>
            <span>{{ $game->gameDateTime }}</span>
        </fieldset>
    </div>
    <div id="playerScores" class="marginTop20px">
        <fieldset class="marginTop20px">
            <legend>Game Details</legend>
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
    </div>
    <div id="actions" class="marginTop20px">
        <div id="deleteGameForm" class="marginTop20px">
            <form method="POST" action="{{ \route('game.delete') }}">
                @csrf
                @method('DELETE')
                <input type="hidden" name="gameId" value="{{ $game->id }}"/>
                <button type="submit" id="deleteGameButton">Delete Game</button>
            </form>
        </div>
    </div>
@endsection
