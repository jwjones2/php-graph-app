@extends('layout')

@section('content')
<a href="/searches/create" class="btn btn-primary">Add a Custom Graph Search</a>
    @if(count($searches) > 0)
    <div class="card-group">
        @foreach($searches as $search)
        <div class="card" style="width: 18rem;">
            <div class="card-header mb-2 bg-info text-white font-weight-bold">
                {{$search->name}}
            </div>

            <ul class="list-group list-group-flush">
                <li class="list-group-item">Description: {{$search->description}}</li>
                <li class="list-group-item">Graph Query:  {{$search->query}}</li>
                <li class="list-group-item">Settings Title:  {{$search->title}}</li>
                <li class="list-group-item">
                    <a href="/searches/{{$search->id}}/edit"><button class="btn btn-warning">Edit</button></a>
                    <form action="/searches/{{$search->id}}" method="post" onsubmit="return confirm('Are you sure you want to delete this?')" style="float: right">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </li>
            </ul>
        </div>
        @endforeach
    </div>
    @else
        <h3>There are no search queries.</h3>
    @endif
    
@endsection