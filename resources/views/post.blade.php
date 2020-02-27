@extends('layouts.post_front')

@section('title', 'Post Page')

@section('content')
<div class="row" id="container">

    <!-- Post Content Column -->
    <div class="col-lg-8">

        <!-- Title -->
        <h1 class="mt-4">{{$post->title}}</h1>

        <!-- Author -->
        <p class="lead">
            by
            <a href="#">{{$post->user->username}}</a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p>{{Carbon\Carbon::parse($post->created_at)->format('d/m/Y H:i:s')}}</p>

        <hr>

        <!-- Preview Image -->
        <img class="img-fluid rounded" src="{{url($post->photo->path)}}" alt="">

        <hr>

        <!-- Post Content -->
        <p class="lead">{!! $post->body !!}</p>

        <hr>
        @auth
        <!-- Comments Form -->
        <div class="card my-4">
            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">
                <form action="{{route('home.comment')}}" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="body" id="comment"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    @error('body')<span>&nbsp;* {{$message}}</span>@enderror
                    @if(session('create_comment_message'))
                      <span class="text-info">&nbsp;* {{session('create_comment_message')}}</span>
                    @endif
                    @if(session('create_reply_message'))
                      <span class="text-info">&nbsp;* {{session('create_reply_message')}}</span>
                    @endif
                </form>
            </div>
        </div>
        @endauth
        @guest
        <div class="card my-4">
            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">
                <p>You must be Logged in to Leave a Comment.</p>
            </div>
        </div>
        @endguest
        <!-- Single Comment -->
        @foreach($comments as $comment)

        <div class="media mb-4">
            <img class="d-flex mr-3 rounded-circle" height=50 src="{{url('images/'.$comment->user->avatar)}}" alt="">
            <div class="media-body">
                <h5 class="mt-0">{{$comment->user->username}}</h5>
                <p>{{$comment->body}}</p>
                <a href="" class="comment-reply" data-comment-id="{{$comment->id}}">Reply</a>
                <div class="reply-body" data-reply-comment-id="{{$comment->id}}">
                    <form action="{{route('home.reply')}}" method="POST">
                        @csrf
                        <input type="hidden" name="comment_id" value="{{$comment->id}}">
                        <textarea name="reply_body" rows="1" class="form-control"></textarea>
                        <input type="submit" name="submit" value="Submit" class="btn btn-info">
                        @error('reply_body')<span class="text-danger"> * {{$message}} @enderror
                    </form>
                </div>
                @if($comment->replies)
                  @foreach($comment->replies as $reply)
                    @if($reply->is_active != 0)
                      <div class="media mt-4">
                          <img class="d-flex mr-3 rounded-circle" height=50 src="{{url('images/'.$reply->user->avatar)}}"
                              alt="">
                          <div class="media-body">
                              <h5 class="mt-0">{{$reply->user->username}}</h5>
                              <p>{{$reply->body}}</p>
                          </div>
                      </div>
                    @endif
                  @endforeach
                @endif
            </div>
        </div>
        @endforeach

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

@section('script')
<script>
$('.reply-body').hide();
$('.media-body a.comment-reply').on('click', function(e) {
    e.preventDefault();
    var aId = $(this).data('comment-id');
    $('.reply-body').each(function() {
        if ($(this).data('reply-comment-id') == aId) {
            $(this).show(400);
        } else {
            $(this).hide();
        }
    })
})
</script>
@endsection