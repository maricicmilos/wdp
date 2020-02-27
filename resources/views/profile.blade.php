@extends('layouts.post_front')

@section('content')
<div class="row" id="container">
    <!-- Post Content Column -->
    <div class="col-lg-8">
        <div class="row" id="profile-header" style="margin-top:1.20em;">
            <div class="col-lg-3" id="profile-image-holder">
                <img src="{{url('images/' . $user->avatar)}}" alt="">
            </div>

            <div class="col-lg-7" id="profile-user-data">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Full Name:</th>
                            <th>{{ $user->fname . ' ' . $user->lname  }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                            <td scope="row">Username:</td>
                            <td>{{$user->username}}</td>
                        </tr>
                        <tr>
                            <td scope="row">Email:</td>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Status:</th>
                            <th>{{$user->role->name}}</th>
                        </tr>
                        <tr>
                            <td scope="row">Signed in:</td>
                            <td>{{Carbon\Carbon::parse($user->created_at)->format('d/m/Y')}}</td>
                        </tr>
                        <tr>
                            <td scope="row">Last Update:</td>
                            <td>{{$user->updated_at->diffForHumans()}}</td>
                        </tr>
                        <tr>
                            <td scope="row">Statistics:</td>
                            <td>
                                <span class="statistsic-item text-muted"><i class="fas fa-comment-alt"></i>&nbsp;{{$user->countAllComments()}}</span>
                                <span class="statistsic-item text-primary"><i class="fas fa-thumbs-up"></i>&nbsp;{{$user->countApprovedComments()}}</span>
                                <span class="statistsic-item text-danger"><i class="fas fa-thumbs-down"></i>&nbsp;{{$user->countUnapprovedComments()}}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
        <div class="row" id="profile-comment-section">
            <div class="profile-comment">
                @if(count($user->comments) > 0)
                    @foreach($user->comments as $comment)
                    <h5 class="mt-0"><a href="{{route('home.post', ['id' => $comment->post->id])}}">{{$comment->post->title}}</a></h5>
                    @if($comment->is_active == 1)    
                        <div class="media mb-4">
                    @else
                        <div class="media mb-4 na-comment">
                    @endif
                            <img class="d-flex mr-3 rounded-circle" height=50 src="{{url('images/'. $comment->user->avatar)}}" alt="">
                            <div class="media-body">
                                <h5 class="mt-0">{{$comment->title}}</h5>
                                <p>{{$comment->body}}</p>
                                @if($comment->is_active == 0)
                                    <p><span class="text-danger">Comment has not been approved</span></p>
                                @endif
                                @if($comment->replies)
                                    @foreach($comment->replies as $reply)
                                        @if($reply->is_active != 0)
                                            <div class="media mt-4">
                                                <img class="d-flex mr-3 rounded-circle" height=50 src="{{url('images/'.$reply->user->avatar)}}" alt="">
                                                <div class="media-body">
                                                    <h5 class="mt-0">{{$reply->user->username}}</h5>
                                                    <p>{{$reply->body}}</p>
                                                </div>
                                            </div>
                                            @else
                                            <div class="media mt-4 na-comment">
                                                <img class="d-flex mr-3 rounded-circle" height=50 src="{{url('images/'. $reply->user->avatar)}}" alt="">
                                                <div class="media-body">
                                                    <h5 class="mt-0">{{$reply->user->username}}</h5>
                                                    <p>{{$reply->body}}</p>                                                    
                                                    <p><span class="text-danger">Comment has not been approved</span></p>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <hr>
                    @endforeach
                @endif
                    @if($user->replies)
                        @foreach($user->replies as $reply)
                            <h5 class="mt-0"><a href="{{route('home.post', ['id' => $reply->comment->post_id])}}">{{$reply->comment->post->title}}</a></h5>
                            <div class="media mb-4" id="">
                                <img class="d-flex mr-3 rounded-circle" height=50 src="{{url('images/' . $reply->comment->user->avatar)}}" alt="">
                                <div class="media-body">
                                    <h5 class="mt-0">{{$reply->comment->user->username}}</h5>
                                    <p>{{$reply->comment->body}}</p>
                                            @if($reply->is_active != 0)
                                                <div class="media mt-4">
                                                    <img class="d-flex mr-3 rounded-circle" height=50 src="{{url('images/' . $reply->user->avatar)}}" alt="">
                                                    <div class="media-body">
                                                        <h5 class="mt-0">{{$reply->user->username}}</h5>
                                                        <p>{{$reply->body}}</p>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="media mt-4 na-comment">
                                                    <img class="d-flex mr-3 rounded-circle" height=50 src="{{url('images/'. $reply->user->avatar)}}" alt="">
                                                    <div class="media-body">
                                                        <h5 class="mt-0">{{$reply->user->username}}</h5>
                                                        <p>{{$reply->body}}</p>
                                                        <p><span class="text-danger">Comment has not been approved</span></p>
                                                    </div>
                                                </div>
                                            @endif
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    @endif
                
            </div>
        </div>       
    </div>

    <!-- Sidebar Widgets Column -->
    <div class="col-md-4">

        <!-- Search Widget -->
        <div class="card my-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-secondary" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>

        <!-- Categories Widget -->
        <div class="card my-4">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="#">Web Design</a>
                            </li>
                            <li>
                                <a href="#">HTML</a>
                            </li>
                            <li>
                                <a href="#">Freebies</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="#">JavaScript</a>
                            </li>
                            <li>
                                <a href="#">CSS</a>
                            </li>
                            <li>
                                <a href="#">Tutorials</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Side Widget -->
        <div class="card my-4">
            <h5 class="card-header">Side Widget</h5>
            <div class="card-body">
                You can put anything you want inside of these side widgets. They are easy to use, and feature the new
                Bootstrap 4 card containers!
            </div>
        </div>

    </div>
</div>
@endsection