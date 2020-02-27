@extends('layouts.app')

@section('title', 'Create User')

@section('content')
<div class="row col-12">
    <div class="row col-12">
        <h2><i class="fas fa-user-plus"> Create User</i></h2>
    </div>
    <div class="col-6" style='padding:40px;'>        

        {!! Form::open(['method' => 'POST',  'action' => 'UserController@store', 'files' => true]) !!} <!-- 'action' => 'MyUsersController@store', -->

        @csrf

        {!! Form::label('username', 'Username:') !!} <span class="text-danger">@error('username') * {{ $message }}
            @enderror</span>
        {!! Form::text('username', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Enter name']) !!}

        {!! Form::label('email', 'Email:') !!} <span class="text-danger">@error('email') * {{ $message }}
            @enderror</span>
        {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' =>
        'name@example.com']) !!}

        {!! Form::label('password', 'Password:') !!} <span class="text-danger">@error('password') * {{ $message }}
            @enderror</span>
        {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Enter password']) !!}

        {!! Form::label('re_password', 'Repeat Password:') !!} <span class="text-danger">@error('re-password') *
            {{ $message }} @enderror</span>
        {!! Form::password('re_password', ['class' => 'form-control', 'id' => 're_password', 'placeholder' => 'Repeat your password']) !!}

        {!! Form::label('fname', 'Firstname:') !!} <span class="text-danger">@error('fname') * {{ $message }}
            @enderror</span>
        {!! Form::text('fname', null, ['class' => 'form-control', 'id' => 'fname', 'placeholder' => 'Enter firstname'])
        !!}

        {!! Form::label('lname', 'Lastname:') !!} @error('lname')<span class="text-danger"> * {{ $message }}
            @enderror</span>
        {!! Form::text('lname', null, ['class' => 'form-control', 'id' => 'lname', 'placeholder' => 'Enter lastname'])
        !!}
        <label for="role_id">Role:</label>@error('role_id')<span class="text-danger">* {{$message}} </span>@enderror
        <select name="role_id" class="form-control">
            @foreach($roles as $id => $role)
                <option value="{{$id}}">{{$role}}</option>
            @endforeach
        </select>

    </div>

    <div class="col-3" style='padding:40px;'>
        <div class="d-flex justify-content-center mb-4"><i class="far fa-user-circle fa-10x"></i></div>
        
        <div class="d-flex justify-content-center mb-2"><label for="avatar">Choose a profile picture:</label></div>
        <div class="d-flex justify-content-center"><input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" class="form-control-file"></div>
    </div>
</div>
<div class="row col-12 pl-5">
    {!! Form::submit('Add User' , ['class' => 'btn btn-primary', 'id' => 'submit']) !!}

    {!! Form::close() !!}
</div>
@endsection