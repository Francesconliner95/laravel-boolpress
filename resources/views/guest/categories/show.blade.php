@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>GUEST</h1>
        <h2>Category</h2>
        <div>
            {{-- stampo il nome della categoria selezionata --}}
            <h3>{{ $category->name}}</h3>

            {{-- mostro tutti i post con questa categoria --}}
            @foreach ($category->posts as $post)
                <li>{{$post->title}}</li>
            @endforeach

        </div>
    </div>
@endsection
