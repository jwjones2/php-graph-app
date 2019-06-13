@extends('layout')

@section('content')
<a href="javascript:history.back()" class="btn btn-outline-dark">&larr;Go Back</a>
<div class="container">
    <h2 class="header">Edit Query</h2>
    <form action="/searches/{{$search->id}}" method="post" id="groupForm">
        @method('PATCH')
        @csrf
    <table class="table form-group">
        <tr>
            <td>
                <input type="text" class="form-control" name="name" value="{{ $search->name }}" placeholder="Custom Search Name" />
            </td>
        </tr><tr>
            <td>
                <input type="text" class="form-control" name="query" value="{{ $search->query }}" placeholder="Query" />
            </td>
        </tr>
        </tr><tr>
            <td>
                <input type="text" class="form-control" name="title" value="{{ $search->title }}" placeholder="Parameter to serve as the title..." />
            </td>
        </tr>
        <tr>
            <td>
                <textarea form="groupForm" class="md-textarea form-control" name="description" placeholder="Query description...">{{ $search->description }}</textarea>
                <button class="btn btn-primary shift-down-sm md-2" type="submit">Edit</button>
            </td>
        </tr>
    </table>
    </form>
</div>
@endsection
