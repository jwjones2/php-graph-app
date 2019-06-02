@extends('layout')

@section('content')
<h1>TESTING</h1>

@foreach($events as $event)
    <h1 style="color: red">Display Name  -- {{$event->getDisplayName()}}</h1>
    <h3 style="color: green">Description:  {{$event->getDescription()}}</h3>
    <hr />
@endforeach