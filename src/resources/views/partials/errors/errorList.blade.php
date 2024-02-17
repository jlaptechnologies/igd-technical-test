@section('css')
    @parent
    #errors fieldset {
        background-color: #ff747e;
        font-weight: bold;
    }
@endsection
<div id="errors" style="width:100vw;">
    <fieldset>
        <legend>There were errors processing your request</legend>
        <ul style="list-style: none;">
        @foreach($errors->all() as $error)
            <li>&gt;&nbsp;{{ $error }}</li>
        @endforeach
        </ul>
    </fieldset>
</div>
