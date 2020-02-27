@extends('layouts.app')

@section('title', 'Update Post')

@section('content')

<div class="row col-12">
    <div class="row col-12">
        <h1>Update Post</h1>
    </div>
    <form class="row col-12" action="{{route('posts.update', ['post' => $post->id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PATCH">
        <div class="col-5">
            <img height="300px" src="{{url($post->photo->path)}}" alt="">
            <input type="hidden" name="cur_photo" value="{{$post->photo->path}}">

            <label for="photo">Change Post Picture</label>@error('photo')<span class="text-danger">* {{$message}}</span>@enderror
            <input type="file" name="photo" class="form-control-file">
        </div>
        <div class="col-6">
            <label for="category_id">Post Category</label>@error('category_id')<span class="text-danger">*
                {{$message}}</span> @enderror
            <select name="category_id" id="category" class="form-control">
                @foreach($categories as $value => $category)
                    @if($post->category_id == $value)
                        <option value="{{$value}}" selected>{{$category}}</option>
                    @else
                        <option value="{{$value}}">{{$category}}</option>
                    @endif
                @endforeach
            </select>

            <label for="title">Title:</label>@error('title')<span class="text-danger">* {{$message}}</span> @enderror
            <input type="text" name="title" class="form-control" placeholder="Enter Post's title" value="{{$post->title}}">

            <label for="body">Post's Content</label>@error('body')<span class="text-danger">* {{$message}}</span>@enderror
            <textarea name="body" class="form-control" rows=8>{{$post->body}}</textarea>
            
            <input type="submit" name="submit" id="submit" value="Update" class="btn btn-primary">
    </form>
    <form action="{{route('posts.destroy', ['post' => $post->id])}}" method="POST" style="display:inline;">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <input type="submit" name="submit" id="submit" value="Delete" class="btn btn-danger">
    </form>
</div>

@endsection