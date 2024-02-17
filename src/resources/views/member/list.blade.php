@extends('templates.main')
@section('title', 'All Members')
@section('css')
    @parent
    #memberTable {
        outline: black 1px solid;
    }
    #memberTable tbody tr.grey {
        background-color: #aaaaaa;
    }
    #memberTable tbody tr td:nth-child(2) {
        text-align: center;
    }
@endsection
@section('content')
    @if(empty($members))
        <div>
            <b>Currently no data exist in the database regarding members.</b>
        </div>
    @endif
    <table id="memberTable">
        <thead>
        <tr>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($members as $idx => $member)
            <tr @if($idx % 2 === 0)class="grey"@endif>
                <td>
                    @include('partials.member.memberLink', ['member'=>$member])
                </td>
                <td>
                    @include('partials.memberDetails.memberDetailsLink', ['member'=>$member])
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
