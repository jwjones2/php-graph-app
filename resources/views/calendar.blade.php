@extends('layout')

@section('content')

@inject('provider', 'App\Http\Controllers\CalendarController');

<div class="row"> 
    <div class="col-4">
        <ul class="list-group position-fixed" style="width: 33%; overflow-y: scroll;">
        @for($c = 0; $c < count($data['value']); $c++ )
            <a href="#{{$data['value'][$c]['id']}}" class="list-group-item">{{$data['value'][$c][$display_title]}}</a>
        @endfor
        </ul>
    </div>

    <div class="col-8" style="width: 66%">
        <h1>{{$search_name}}</h1>
@for($c = 0; $c < count($data['value']); $c++ )
<a class="anchor" name="{{$data['value'][$c]['id']}}">link</a>
<br /><br />
<table class="table table-striped">
    <!--
    <thead class="thead-dark">
        <tr>
            <th scope="col">Setting Name</th>
            <th scope="col">Setting Value</th>
        </tr>
    </thead>
    <tbody>
    -->
        <tr class="table-info font-weight-bold border border-dark"><td colspan="2">{{$data['value'][$c][$display_title]}}</td></tr>
    @foreach ( $data['value'][$c] as $key => $value) 
        @if ($key == $display_title)
            @continue
        @endif

        @if ( gettype($value) != "array" )
        <tr> 
            <td>{{$provider::convert_camel_case($key) }}</td>
            <td>{{ $provider::check_value($value) }}</td>
        </tr>
        @elseif ( count($value) == 0 )
        <tr>
            <td>{{ $provider::convert_camel_case($key) }}</td>
            <td>Not Set</td>
        </tr>
        @else
        <tr class="table-warning">
            <td colspan="2">
                {{ $provider::convert_camel_case($key) }}
            </td>
        </tr>
            @if( array_key_exists(0, $value) )
                @for($i = 0; $i < count($value); $i++ )
                    <tr class="table-secondary font-weight-bold"><td colspan="2">{{$value[$i][$display_title]}}</td></tr>
                    @foreach ( $value[$i] as $k => $v )
                        @if ($k == '@odata.type')
                            @continue
                        @endif
                    <tr class="font-italic">
                        <td>{{ $provider::convert_camel_case($k) }}</td>
                        <td>{{$provider::check_value($v)}}</td>
                    </tr>
                    @endforeach
                @endfor
            @else
                @foreach($value as $k => $v ) 
                <tr class="font-italic">
                    <td>{{ $provider::convert_camel_case($k) }}</td>
                    <td>{{$provider::check_value($v)}}</td>
                </tr>
                @endforeach
            @endif
        @endif
    @endforeach  
    </tbody>
</table>
@endfor
    </div>
</div>


@stop
