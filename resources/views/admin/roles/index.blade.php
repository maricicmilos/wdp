@extends('layouts.app')

@section('title', 'Roles')

@section('content')
<div class="row col-12">
    <div class="row col-12">
        <h1>Roles</h1>
    </div>
    <div class="col-6">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Role Name</th>
                </tr>
            </thead>
            <tbody>
                @if(count($roles) == 0)
                    <tr>
                        <td span=2>Currently there are no records in database</td>
                    </tr>
                @else
                    @foreach($roles as $role)
                    <tr>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>       
        @if(session('msg'))
             <p id="msg"> {{ session('msg') }} </p>
         @endif       
    </div>
</div>

@endsection