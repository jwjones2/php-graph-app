@extends('layout')

@section('content')
@foreach ( $data['value'][0] as $key => $value) 
    <h1>KEY: {{$key}} </h1>
        @if ( gettype($value) != "array" ) 
          <h1 style='color:red'>VALUE: {{$value}}</h1>
        @else
            @for($i = 0; $i < count($value); $i ++ )
                @foreach ( $value[$i] as $k => $v )
                    <h1>KEY {{$k}}  VALUE  {{$v}}</h1>
                @endforeach
            @endfor
        @endif
@endforeach  
@stop
