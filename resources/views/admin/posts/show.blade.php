@extends('layouts.app')

@section('content')
<div class="container">
    @include('admin/navbar')
    <h2>Posts</h2>
    <div>
        <p>{{$post->title}}</p>
        <p>{{$post->description}}</p>
        {{--
        $post = vogliamo prendere un dato dalla tabella post
        category = funzione dichiarata nel model Post.php  da  utilizzare senza parentesi  category(), laravel in automatico capisce che sono collegate in quanto l'abbiamo specificato nella migration ponte (AddForeignCategoryPostsTable).
        name = vogliamo prendere solo il nome di quella categoria (nome generato in CategoriesTableSeader.php)--}}
        <p>Categoria: {{$post->category ? $post->category->name : '-'}}</p>
        {{-- nel ternario verifichiamo che l post abbia una categoria associata, se si la stampiamo altrimenti no '-' --}}
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
