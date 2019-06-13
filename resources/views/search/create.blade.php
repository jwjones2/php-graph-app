@extends('layout')

@section('content')
<a href="javascript:history.back()" class="btn btn-outline-dark">&larr;Go Back</a>
<div class="container">
    <h2 class="header">Add a Group</h2>
    <form action="{{ action('SearchController@store') }}" method="post" id="groupForm">
        @csrf
    <table class="table form-group">
    <tr>
            <td>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Custom Search Name" />
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" class="form-control" name="query" value="{{ old('query') }}" placeholder="Query" />
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Parameter to serve as the title." />
                <small>This will be the parameter setting that will serve as the title for each device/setting...</small>
            </td>
        </tr>
        <tr>
            <td>
                <textarea form="groupForm" class="md-textarea form-control" name="description" placeholder="Query description...">{{ old('description') }}</textarea>
                <button class="btn btn-primary shift-down-sm md-2" type="submit">Create</button>
            </td>
        </tr>
    </table>
    </form>
</div>
@endsection
