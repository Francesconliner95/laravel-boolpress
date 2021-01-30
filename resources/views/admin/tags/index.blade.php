@extends('layouts.app')

@section('content')
<div class="container">
    @include('admin/navbar')
    <h2>Tags</h2>
    <div>
        <div>
        <a href="{{ route('admin.tags.create')}}">Aggiungi Nuovo Tag</a>
        </div>
        <table>
            <thead>
                <th>ID</th>
                <th>Nome Tag</th>
            </thead>
        @foreach ($tags as $tag)
            <tbody>
                <td>
                    <span>{{$tag->id}}</span>
                </td>
                <td>
                    <span>{{$tag->name}}</span>
                </td>
                <td>
                    {{-- <a href="{{ route('admin.posts.show', ['post'=> $post->id])}}"> --}}
                    <form method="post" action="{{ route('admin.tags.destroy', ['tag'=> $tag->id])}}" class="d-inline-block">
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
