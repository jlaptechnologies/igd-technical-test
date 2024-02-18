@extends('templates.main')
@section('title', 'Record new game data')
@section('css')
    @parent
    #gameDetails {
        display: grid;
        grid-auto-flow: row;
        grid-gap: 20px;
        grid-template-columns: 300pt 300pt;
    }
    #gameDetails form button.submitButton {
        margin-top:10px;
        float:right;
    }
@endsection
@section('content')
    <div id="gameDetails">
        <form method="POST" action="{{ \route('game.insert') }}">
            @method('POST')
            @for($playerIndex = 0; $playerIndex <= 3; $playerIndex++)
                <fieldset>
                    <legend>Player {{ $playerIndex+1 }}</legend>
                    <div style="display:block;">
                        <label for="player_{{ $playerIndex }}">Player</label>
                        <select id="player_{{ $playerIndex }}" name="player[{{ $playerIndex }}][memberId]">
                            @foreach($members as $member)
                                <option value="{{ $member->id }}">{{ $member->firstName }} {{ $member->lastName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="display:block;">
                        <label for="player_score_{{ $playerIndex }}">Score</label>
                        <input id="player_score_{{ $playerIndex }}" name="player[{{ $playerIndex }}][playerScore]" type="text"
                               pattern="\d{1,3}" min="0"/>
                    </div>
                </fieldset>
            @endfor
            <div class="marginTop20px" style="display:block;">
                <label for="gameDateTime">Date and Time</label>
                <input id="gameDateTime" name="gameDateTime" type="datetime-local">
            </div>
            <div class="marginTop20px" style="display:block;">
                <button class="submitButton" type="submit">Create</button>
            </div>
            @csrf
        </form>
    </div>
@endsection
