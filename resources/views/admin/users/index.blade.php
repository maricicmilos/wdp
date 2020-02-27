@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="row-12" style='padding:40px;'>
    <h1>Users</h1>
    <table class="table" id="users_table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Avatar</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <th scope="row"><a href="{{route('users.show', ['user' => $user->id])}}"><img src="../images/{{$user->avatar}}" alt="User Avatar" class="rounded-circle border-0" style="height:70px;"></a></th>
                <td>{{$user->username}}</td>
                <td>{{$user->email}}</td>
                <td><a href="{{route('users.show', ['user' => $user->id])}}"><button type="button" class="btn btn-light">Go to Profile</button></a></td>
            </tr>
            @endforeach

        </tbody>
        @include('admin._inc.msg')
    </table>
</div>
<div class="d-flex justify-content-center">
    <div>
        {{$users->render()}}
    </div>
</div>
@endsection