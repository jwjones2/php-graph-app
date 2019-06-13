@extends('layouts.app')

@section('content')
<a href="javascript:history.back()" class="btn btn-outline-dark">&larr;Go Back</a>
<div class="container">
    <h1 class="header">{{ $group->name }}</h1>
    
    <a href="/groups/{{$group->id}}/edit" class="btn btn-warning float-right shadow-lg p-3 mb-5 font-weight-bold">Edit Group</a>

    <blockquote class="text-center">{{ $group->description }}</blockquote>

    <!-- List the Group Members -->

    <br />
    <hr style="width: 50%;">

    <div style="display: block; text-align: center">
        <a href="/groups/{{$group->id}}/members" class="btn btn-warning center-block shadow-lg p-3 mb-5 font-weight-bold">Add Members</a>
        <div class="card">
            <div class="card-header mb-2 bg-info text-white font-weight-bold">
                Group Members
            </div>
        @foreach($group->members as $member)
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <a href="/groups/{{$group->id}}/{{$member->id}}" onclick="return confirm('Are you sure?')" class="btn-sm btn-danger">x</a>&nbsp;&nbsp;{{$member->name}}
                </li>
            </ul>
        @endforeach
        </div>
    </div>
</div>

@endsection

