@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
<h1>User Profile</h1>
<div class="row justify-content-start" style="padding:40px;">
    <div class="col-3">
        <img src="../../images/{{$user->avatar}}" alt="{{ $user->fname . ' ' . $user->lname . ' avatar' }}">
    </div>
    <div class="col-6">
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
                    <td>{{$user->created_at}}</td>
                </tr>
                <tr>
                    <td scope="row">Last Update:</td>
                    <td>{{$user->updated_at->diffForHumans()}}</td>
                </tr>
            </tbody>
        </table>
        <div class="row" id="profile-btns">
            <div class="col align-self-start"><a href="{{ url()->previous() }}"><button type="button" class="btn btn-secondary">Go Back</button></a></div>
            <div class="col align-self-end">
                <a href="{{route('users.edit', ['user' => $user->id])}}"><button type="button" class="btn btn-info" style="width:74px;">Edit</button></a>
                <form action="{{route('users.destroy', ['user' => $user->id])}}" method="POST" style="display:inline;">
                @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" name="submit" value="Delete" class="btn btn-danger">
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection