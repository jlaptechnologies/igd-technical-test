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
    #actions {
        margin-top: 20px;
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
    </div>
    <div id="actions">
        @include('partials.memberDetails.memberDetailsLink', ['member'=>$member])
    </div>
@endsection
