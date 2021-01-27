@extends('layouts.app')

@section('content')
<div class="container">
    <h1>GUEST</h1>
    <h2>Posts</h2>
    <div class="row justify-content-center">
        <table>
            <thead>
                <th>Titolo</th>
                <th>Descrizione</th>
            </thead>
            @foreach ($posts as $post)
            <tbody>
                <td>{{$post->title}}</td>
                <td>{{$post->description}}</td>
                <td>
                    <a href="{{ route('guest.posts.show', ['param'=> $post->slug])}}">
                        Maggiori Dettagli</a>
                </td>
            </tbody>
            @endforeach
        </table>
    </div>
</div>
@endsection
