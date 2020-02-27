@extends('layouts.app')

@section('title', 'Create Role')

@section('content')
<div class="row col-12">
    <div class="row col-12">
        <h2>Create Role</h2>
    </div>
    <div class="col-6 mt-3">
        <form action="{{route('roles.store')}}" method="POST">
        @csrf
            <label for="name">Enter Role Name</label>@error('name')<span class="text-danger">* {{$message}} </span>@enderror
            <input type="text" name="name" class="form-control" placeholder="exp. Administrator, Guest...">

            <input type="submit" name="submit" value="Create Role" class="btn btn-primary" id="submit">
        </form>
    </div>        

</div>
@endsection