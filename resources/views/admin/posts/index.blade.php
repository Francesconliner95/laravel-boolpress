@extends('layouts.app')

@section('content')
<div class="container">
    <h1>ADMIN</h1>
    <h2>Posts</h2>
    <div class="row justify-content-center">
        @foreach ($posts as $post)
            <p>{{$post->title}}</p>
            <p>{{$post->description}}</p>
        @endforeach
    </div>
</div>
@endsection
