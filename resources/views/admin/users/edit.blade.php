@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<h1><i class="fas fa-user-edit"> Edit User</i></h1>
<div class="row" style='padding:40px;'>
    <div class="col-6">
        <form action="{{route('users.update', ['user' => $user->id])}}" method="POST" enctype="multipart/form-data">

            @csrf
            <input type="hidden" name="_method" value="PUT"> 
            <input type="hidden" value="{{$user->id}}" name="id">

            <label for="username">Username:</label>
            <input type="text" name="username" value="{{$user->username}}" class="form-control" id="username">

            <label for="email">Email:</label>
            <input type="email" name="email" value="{{$user->email}}" class="form-control" id="email">

            <label for="fname">Firstname:</label>
            <input type="text" name="fname" value="{{$user->fname}}" class="form-control" id="fname">

            <label for="lname">Lastname:</label>
            <input type="text" name="lname" value="{{$user->lname}}" class="form-control" id="lname">

            <label for="role_id">Status</label>
            <select name="role_id" class="form-control">
                @foreach($roles as $role)
                    @if($user->role_id == $role->id)
                        <option value="{{$role->id}}" selected>{{$role->name}}</option>
                    @else
                        <option value="{{$role->id}}">{{$role->name}}</option>
                    @endif
                @endforeach
            </select>

            <label for="avatar">Change Avatar:</label>
            <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" class="form-control-file">
            <input type="hidden" value="{{$user->avatar}}" name="cur_avatar">

            <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Edit User">

        </form>
    </div>
    <div class="col-3 d-flex justify-content-center pt-4">
        <div>
            <img src="{{asset('images')}}/{{$user->avatar}}" alt="{{ $user->fname . ' ' . $user->lname . ' avatar' }}">
        </div>
    </div>

</div>
@endsection