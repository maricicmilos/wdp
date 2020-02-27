@extends('layouts.post_front')

@section('title', 'Web Development Portal')

@section('content')

    <div class="row">
        <div class="glide">
            <div class="glide__track" data-glide-el="track" id="slider_holder">
                <ul class="glide__slides">
                    <li class="glide__slide"><img src="{{url('images//layout/1920x1140-1.jpg')}}" alt="Web Development"></li>
                    <li class="glide__slide"><img src="{{url('images//layout/1920x1140-2.jpg')}}" alt="Web Development"></li>
                    <li class="glide__slide"><img src="{{url('images//layout/1920x1140-3.jpg')}}" alt="Web Development"></li>
                </ul>
            </div>
            <div class="glide__arrows" data-glide-el="controls">
                <button class="glide__arrow glide__arrow--left" data-glide-dir="<">prev</button>
                <button class="glide__arrow glide__arrow--right" data-glide-dir=">">next</button>
            </div>

        </div>
    </div>
    <div class="row-12">
      <div class="row justify-content-md-center">
          <div style="margin:4em 0;">
              <ul style="list-style-type: none;">
                  <li style="display:inline-block;">
                      <div style="margin:1em 2em; text-align:center; width:300px;">
                          <i style="color:#59bdcc" class="fas fa-database fa-10x"></i>
                          <p style="margin-top:1em; color:#0061c5;">Database Arch</p>
                      </div>
                  </li>
                  <li style="display:inline-block;">
                      <div style="margin:1em; text-align:center; width:300px;">
                          <i style="color:#59bdcc" class="fab fa-connectdevelop fa-10x"></i>
                          <p style="margin-top:1em; color:#0061c5;">Community Connecting</p>
                      </div>
                  </li>
                  <li style="display:inline-block;">
                      <div style="margin:1em; text-align:center; width:300px;">
                          <i style="color:#59bdcc" class="fas fa-laptop fa-10x"></i>
                          <p style="margin-top:1em; color:#0061c5;">Dev Tools</p>
                      </div>
                  </li>
              </ul>
          </div>
      </div>
</div>
<div class="row" id="container">
    <!-- Post Content Column -->
    <div class="col-lg-8">
        <hr>
        <h2>Posts /</h2>
        <hr>
        @foreach($posts as $post)
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
        <a href="{{route('home.post', ['id' => $post->id])}}"><img class="img-fluid rounded"
                src="{{url($post->photo->path)}}" alt=""></a>

        <hr>
        <!-- Post Content -->
        <p class="lead">{!!Str::limit($post->body, 600)!!}</p>
        <p><a href="{{route('home.post', ['id' => $post->id])}}">More details...</a></p>
        <hr>
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
<script src="../node_modules/@glidejs/glide/dist/glide.min.js"></script>

<script>
  
  new Glide('.glide', {
  type: 'carousel'
}).mount()
</script>

@endsection