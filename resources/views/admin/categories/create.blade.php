@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
<div class="row col-12">
    <div class="row col-12">
        <h2>Create Category</h2>
    </div>
    <div class="col-6 mt-3">
        <form action="{{route('categories.store')}}" method="POST">
        @csrf
            <label for="name">Enter Category Name</label>@error('name')<span class="text-danger">* {{$message}} </span>@enderror
            <input type="text" name="name" class="form-control" placeholder="exp. PHP, jQuery...">

            <input type="submit" name="submit" value="Create Category" class="btn btn-primary" id="submit">
        </form>
    </div>        

</div>
@endsection