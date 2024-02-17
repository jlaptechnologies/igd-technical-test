@extends('templates.main')
@section('title', 'Edit contact details for '.$member->firstName.' '.$member->lastName)
@section('css')
    @parent
    #memberDetails {
        display: grid;
        grid-auto-flow: row;
        grid-gap: 20px;
        grid-template-columns: 300pt 300pt;
    }
    #memberDetails form button.submitButton {
        margin-top:10px;
        float:right;
    }
@endsection
@section('content')
    <div id="memberDetails">
        <form method="POST" action="{{ route('member.updateMemberDetails') }}">
            @method('PUT')
            <fieldset>
                <legend>Edit contact details for {{ $member->firstName }} {{ $member->lastName }}</legend>
                <label for="email">Email</label>
                <input id="email" name="email" type="email" min="5" max="96" value="{{ $member->memberDetail->email }}"/>
                <input type="hidden" name="memberId" value="{{ $member->id }}"/>
            </fieldset>
            <button class="submitButton" type="submit">Update</button>
            @csrf
        </form>
    </div>
@endsection
