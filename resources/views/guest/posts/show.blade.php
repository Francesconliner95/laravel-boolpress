@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>GUEST</h1>
        <h2>Posts</h2>
        <div>
            <p>{{$post->title}}</p>
            <p>{{$post->description}}</p>
            {{--
            $post = vogliamo prendere un dato dalla tabella post
            category = funzione dichiarata nel model Post.php  da  utilizzare senza parentesi  category(), laravel in automatico capisce che sono collegate in quanto l'abbiamo specificato nella migration ponte (AddForeignCategoryPostsTable).
            name = vogliamo prendere solo il nome di quella categoria (nome generato in CategoriesTableSeader.php)--}}

            {{-- verifichiamo che il post abbia una categoria associata, se si la stampiamo il nome della categoria altrimenti '-' --}}
            <p>Categoria:
                @if ($post->category)
                    {{-- la categoria sarà cliccabile e la facciamo puntare alla rotta 'categories.show' che ci mostrerà tutti i post con la categoria selezionata --}}
                    <a href="{{ route('categories.show', ['category'=>$post->category->slug])}}">
                        {{$post->category->name}}
                    </a>
                @else
                    -
                @endif
            </p>
            <p>Tags:
                @forelse ($post->tags as $tag)
                    {{$tag->name}}{{!$loop->last?',':''}}
                @empty
                    -
                @endforelse
            </p>
        </div>
    </div>
@endsection
