@extends('layouts.app')

@section('content')
<a href="javascript:history.back()" class="btn btn-outline-dark">&larr;Go Back</a>
<div class="container form-group">
    <h1 class="header">Add Members to &quot;{{ $group->name }}&quot;</h1>
    <form action="/groups/addmember/{{$group->id}}">
        @foreach($members as $member)
        @if(test_member($member->id, $member_ids))
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="member" name="member[{{$member->id}}]" /> 
                <label for="member" class="form-check-label">{{ $member->name }}</label>
            </div>
        @endif
        @endforeach
        <button class="btn btn-primary shift-down-sm md-2" type="submit">Add</button>
    </form>
</div>

<?php 
    function test_member ($id, $members) {
        foreach($members as $member_id){
            if ($id == $member_id) {
                return false;
            }
        }
        
        return true;
    }
?>


@endsection
