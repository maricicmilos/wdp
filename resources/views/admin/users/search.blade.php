@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="row">
    <div class="col-6" style='padding:40px;'>

        <h2><i class="fas fa-search"> Find User</i></h2>

        {!! Form::open(['action' => 'UserController@show_search', 'method' => 'POST']) !!}

        @csrf

        <input type="hidden" value="{{ Request::get('action') }}" name="action">

        {!! Form::label('search_term', 'Find User') !!} <span class="text-danger">@error('search_term') *
            {{$message}}@enderror</span>
        {!! Form::text('search_term', null, ['class' => 'form-control', 'id' => 'search_term', 'placeholder' =>
        'Search...']) !!}

        {!! Form::submit('Find', ['class' => 'btn btn-primary', 'id' => 'submit'])!!}


        {!! Form::close() !!}
    </div>
</div>

<div class="row">
    @unless(isset($users))
        <p style='padding:40px;'>Search results for given term...</p>
    @endunless
    @if(isset($users))
        <div class="col-10 bg-white border border-light rounded" style='padding:40px;'>
            @if(count($users)== 0)
                <p class="bg-white border border-light rounded">No User(s) found</p>
            @else
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Firstname</th>
                            <th scope="col">Lastname</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->fname}}</td>
                            <td>{{$user->lname}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->email}}</td>
                            @if($action == 'edit')
                                <td><a href="{{route('users.edit', ['user' => $user->id])}}"><button type="button" class="btn btn-info">Edit</button></a></td>
                            @endif
                            @if($action == 'delete')
                                <td><a href="{{route('users.delete', ['id' => $user->id])}}"><button type="button" class="btn btn-danger">Delete</button></a></td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @endif    
</div>


@endsection