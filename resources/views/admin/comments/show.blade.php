@extends('layouts.app')

@section('title', 'Update Post')

@section('content')

<div class="row col-12">
    <div class="row col-12">
        <h1>Comment</h1>
    </div>
    <div class="row col-12">
        <table class="table" id="users_table">
            <tbody>
                <tr>
                    <th scope="col">Post</th>
                    <td><a href="{{route('home.post', ['id' => $comment->post->id])}}">{{$comment->post->title}}</a></td>
                </tr>
                <tr>
                    <th scope="col">Author</th>
                    <td>{{$comment->user->username}}</td>
                </tr>
                <tr>
                    <th scope="col">Comment</th>
                    <td>{{$comment->body}}</td>
                </tr>
                <tr>
                    <th scope="col"></th>
                    <td></td>
                </tr>
                
            </tbody>
        </table>
    </div>
    <hr>
    <div class="row col-12">
        <h4>Replies for this comment</h4>
        <hr>
        <table class="table mt-3" id="users_table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Author</th>
                    <th scope="col">Reply</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($comment->replies as $reply)
                <tr>
                    <td><a href="{{route('users.show', ['user' => $reply->user_id])}}"><img
                                src="{{url('images/' . $reply->user->avatar)}}" alt="User Avatar"
                                class="rounded-circle border-0" style="height:50px;"></a></th>
                    <td>{{$reply->user->username}}</td>
                    <td>{{$reply->body}}</td>
                    <td>{{$comment->created_at->diffForHumans()}}</td>
                    <td>
                        @if($reply->is_active == 0)
                            <span class="text-danger">NA</span>
                        @else
                            <span class="text-success">A</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{route('replies.update', ['reply' => $reply->id])}}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            @if($reply->is_active == 0)
                                <input type="hidden" name="is_active" value="1">
                            @else
                                <input type="hidden" name="is_active" value="0">
                            @endif
                            <input type="submit" name="submit" value="Change" class="btn btn-primary">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection