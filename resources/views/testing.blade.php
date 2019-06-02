@extends('layout')

@section('content')
<div class="jumbotron">
    <h1>This is test page one.  A Session variable named COLOR was saved with the value of GREEN.</h1>

    <a href="/test2" class="btn btn-primary">Click here to see if it persisted.</a>
</div>
@endsection