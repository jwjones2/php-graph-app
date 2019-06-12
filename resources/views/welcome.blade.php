@extends('layout')

@section('content')
<div class="jumbotron">
  <h1>Azure Graph Data Search</h1>
  @if(isset($userName))
    <h4>Welcome {{ $userName }}!</h4>
    <p>Click on a button below to search.</p>
  @else
    <a href="/signin" class="btn btn-primary btn-large">Click here to sign in</a>
  @endif
</div>
@endsection