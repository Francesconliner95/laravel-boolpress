@extends('layouts.app')

@section('content')
<div class="container">
    <h1>ADMIN</h1>
    <h2>Posts</h2>
    <div class="row justify-content-center">
        <div>
        <a href="{{ route('admin.posts.create')}}">Aggiungi Nuovo Post</a>
        </div>
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
                    <a href="{{ route('admin.posts.show', ['post'=> $post->id])}}">
                        Maggiori Dettagli</a>
                </td>
                <td>
                    <a href="{{ route('admin.posts.edit', ['post'=> $post->id])}}">
                        Modifica</a>
                </td>
                <td>
                    <form method="post" action="{{ route('admin.posts.destroy', ['post'=> $post->id])}}" >
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="button">
                            Cancella
                        </button>
                    </form>
                </td>
            </tbody>
            @endforeach
        </table>
    </div>
</div>
@endsection
