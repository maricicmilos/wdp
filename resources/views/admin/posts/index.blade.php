@extends('layouts.app')

@section('title', 'Posts')

@section('content')    
<div class="row col-12">
    <div class="row col-12">
        <h1>Posts</h1>
    </div>
    <div class="col-12">
    @if(count($posts) >= 1)
        <table class="table" id="users_table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Photo</th>
                    <th scope="col">User</th>
                    <th scope="col">Category</th>
                    <th scope="col">Title</th>
                    <th scope="col">Created</th>
                    <th scope="col">Updated</th>
                    <th><i class="fas fa-cog"></i></th>
                </tr>
            </thead>
            <tbody>                
                    @foreach($posts as $post)
                        <tr>
                            <td><a href="{{route('home.post', ['id' => $post->id])}}"><img src={{url($post->photo->path)}} alt="Post Photo" style="height:70px;"></a></td>
                            <td><a href="{{route('users.show', ['user' => $post->user->id])}}">{{$post->user->username}}</a></td>
                            <td>{{$post->category->name}}</td>                            
                            <td>{{$post->title}}</td>
                            <td>{{$post->created_at->diffForHumans()}}</td>
                            <td>{{$post->updated_at->diffForHumans()}}</td>
                            <td><a href="{{route('posts.edit', ['post' => $post->id])}}">Manage Post</a></td>
                        </tr>
                    @endforeach
                
            </tbody>
        </table>
        @endif
        @if(session('msg'))
             <p id="msg"> {{ session('msg') }} </p>
         @endif       
    </div>
</div>
@endsection