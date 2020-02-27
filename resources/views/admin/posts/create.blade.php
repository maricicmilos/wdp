@extends('layouts.app')

@section('title', 'Create Post')

@section('content')

<div class="row">
    
    <div class="col-12">
        <h1>Create Post</h1>
    </div>
    <div class="col-12">
        <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="category_id">Select Post Category</label>@error('category_id')<span class="text-danger">* {{$message}}</span> @enderror
            <select name="category_id" id="category" class="form-control">
                @foreach($categories as $value => $category)
                    <option value="{{$value}}">{{$category}}</option>
                @endforeach
            </select>
            
            <label for="title">Title:</label>@error('title')<span class="text-danger">* {{$message}}</span> @enderror
            <input type="text" name="title" class="form-control" placeholder="Enter Post's title">
            
            <label for="body">Post's Content</label>@error('body')<span class="text-danger">* {{$message}}</span> @enderror
            <textarea class="description" name="body" rows=15></textarea>
            
            <label for="photo">Upload picture</label>@error('photo')<span class="text-danger">* {{$message}}</span> @enderror
            <input type="file" name="photo" class="form-control-file">

            <input type="submit" name="submit" id="submit" value="Create Post" class="btn btn-primary">

        </form>
    </div>
</div>

@endsection

@section('scripts')
@include('admin._inc.post_editor')
<script>
    tinymce.init({
        selector:'textarea.description',
        width: 1000,
        height: 400
    });
</script>
@endsection
