@extends('templates.main')
@section('title', 'Edit contact details for '.$member->firstName.' '.$member->lastName)
@section('content')
    <div>
        <form method="POST" action="{{ route('member.updateMemberDetails') }}">
            @method('PUT')
            <fieldset>
                <legend>Edit contact details for {{ $member->firstName }} {{ $member->lastName }}</legend>
                <label for="email">Email</label>
                <input id="email" type="email" min="5" max="96" value="{{ $member->email }}"/>
            </fieldset>
            <button type="submit">Update</button>
        </form>
    </div>
@endsection
