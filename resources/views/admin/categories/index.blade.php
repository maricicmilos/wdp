@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="row col-12">
    <div class="row col-12">
        <h1>Categories</h1>
    </div>
    <div class="col-6">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category Name</th>
                </tr>
            </thead>
            <tbody>
                @if(count($categories) == 0)
                    <tr>
                        <td span=2>Currently there are no records in database</td>
                    </tr>
                @else
                    @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
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