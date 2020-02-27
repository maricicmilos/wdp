@extends('layouts.app')

@section('title', 'Comments')

@section('content')
<div class="row col-12">
    <div class="row col-12">
        <h1>Comments</h1>
    </div>
    <div class="col-12">
    
    @if(count($comments) >= 1)
        <table class="table" id="users_table">
            <thead class="thead-dark">
                <tr>                    
                    <th scope="col">Post</th>
                    <th scope="col">Author</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Replies</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>                
                    @foreach($comments as $comment)
                        <tr>
                            <td><a href="{{route('home.post', ['id' => $comment->post_id])}}">{{Str::limit($comment->post->title, 25)}}</a></td>
                            <td>{{$comment->user->username}}</td>
                            <td>{{$comment->body}}</td>
                            <td>@if($comment::has('replies'))
                                    @if(count($comment->replies) == 0)
                                        [ {{count($comment->replies)}} ]
                                    @else
                                        <a href="{{route('comments.show', ['comment' => $comment->id])}}">[ {{count($comment->replies)}} ]</a>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($comment->is_active == 0)
                                    <span class="text-danger">NA</span>                                
                                @else
                                    <span class="text-success">A</span>
                                @endif                                
                            </td>
                            <td>
                                <form action="{{route('comments.update', ['comment' => $comment->id])}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="PATCH">
                                    @if($comment->is_active == 0) 
                                        <input type="hidden" name="is_active" value="1">     
                                    @elseif($comment->is_active == 1)
                                        <input type="hidden" name="is_active" value="0">
                                    @endif
                                    <input type="submit" name="submit" value="Change" class="btn btn-primary">
                                </form>                                
                            </td>                                    
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
