@extends('layout')

@section('content')


@for($c = 0; $c < count($data['value']); $c++ )
<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Setting Name</th>
            <th scope="col">Setting Value</th>
        </tr>
    </thead>
    <tbody>
    @foreach ( $data['value'][$c] as $key => $value) 
        @if ($key == '@odata.type')
            <tr class="table-info font-weight-bold"><td colspan="2">{{$value}}</td></tr>
            @continue
        @endif
            @if ( gettype($value) != "array" )
            <tr> 
                <td>{{$key}}</td>
                <td>{{$value}}</td>
            </tr>
            @else
            <tr class="table-warning">
                <td colspan="2">{{$key}}</td>
            </tr>    
            @if (count($value) == 0 )
                <td>Empty</td>
            @else
                @if( array_key_exists(0, $value) )
                    @for($i = 0; $i < count($value); $i++ )
                        @foreach ( $value[$i] as $k => $v )
                            @if ($k == '@odata.type')
                                <tr class="table-secondary font-weight-bold"><td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$v}}</td></tr>
                                @continue
                            @endif
                        <tr class="font-italic">
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$k}}</td>
                            @if($v == null)
                            <td>null</td>
                            @else
                            <td>{{$v}}</td>
                            @endif
                        </tr>
                        @endforeach
                    @endfor
                @else
                    @foreach($value as $k => $v ) 
                    <tr class="font-italic">
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$k}}</td>
                        <td>{{$v}}</td>
                    </tr>
                    @endforeach
                @endif
            @endif
        @endif
    @endforeach  
    </tbody>
</table>
@endfor


@stop
