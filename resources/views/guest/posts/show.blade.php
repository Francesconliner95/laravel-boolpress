@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>GUEST</h1>
        <h2>Posts</h2>
        <div class="row justify-content-center">
            <p>{{$post->title}}</p>
            <p>{{$post->description}}</p>
        </div>
    </div>
@endsection
