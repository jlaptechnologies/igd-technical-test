@php use Illuminate\Support\Str; @endphp
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
        <form method="POST" id="newGamePlayersForm" action="{{ \route('game.insert') }}">
            @method('POST')
            <div id="gamePlayers">
            @for($playerIndex = 0; $playerIndex <= 1; $playerIndex++)
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
            </div>
            <div class="marginTop20px" style="display:block;">
                <label for="gameDateTime">Date and Time</label>
                <input id="gameDateTime" name="gameDateTime" type="datetime-local">
            </div>
            <div class="marginTop20px" style="display:block;">
                <button type="button" id="addPlayerButton">Add Player</button>
            </div>
            <div class="marginTop20px" style="display:block;">
                <button class="submitButton" type="submit">Create</button>
            </div>
            @csrf
        </form>
    </div>
@endsection
@section('inlineJs')
    @parent
    <script type="text/javascript">

        let playerCount = 2;

        function createFormComponent(playerId) {
            const formComponent = `
            <fieldset id="playerFieldSet@php echo $fieldSetId = Str::random(8); @endphp">
                <legend>Player ${playerId}</legend>
                <div style="display:block;">
                    <label for="player_[]">Player</label>
                    <select id="player_[]" name="player[${playerId}][memberId]">
                    @foreach($members as $member)
                <option value="{{ $member->id }}">{{ $member->firstName }} {{ $member->lastName }}</option>
                    @endforeach
                </select>
            </div>
            <div style="display:block;">
                <label for="player_score_[]">Score</label>
                <input id="player_score_[]" name="player[${playerId}][playerScore]" type="text"
                pattern="\\d{1,3}" min="0"/>
            </div>
            <div style="display:block">
                <button id="remove{{ $fieldSetId }}" value="{{ $fieldSetId }}" onclick="removePlayer('{{$fieldSetId}}')" type="button">Remove</button>
                </div>
            </fieldset>
            `;
            // This "renders" the html into a HTML5 template element that we can extract the element that we can
            // append to the list
            const template = document.createElement('template');
            template.innerHTML = formComponent;
            return template.content.children[0];
        }

        function removePlayer(id) {
            document.getElementById(`playerFieldSet${id}`).remove();
            playerCount--;
        }

        document.getElementById('addPlayerButton').addEventListener('click', function(){
            document.getElementById('gamePlayers').appendChild(createFormComponent(playerCount+1));
            playerCount++;
        });

    </script>
@endsection
