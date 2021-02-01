@extends('layouts.app')

@section('content')
<div class="container">
    @include('admin/navbar')
    <h1>Modifica</h1>

    {{-- se ci sono errori di input non validi--}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                {{-- me li cicla e me li stampa in pagina--}}
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

{{-- creiamo un form inizialmente inseriamo il metodo post('in quanto il from accetta solo i metodi post e get') e poi andremo a specificare attraveso @method('PUT') il metodo che effettivamente utilizzeremo ovvero PUT, successivamente con action andiamo a specificare a quale rotta si deve collegare e ci passiamo il parametro id dell'oggetto corrente che stiamo andando a modificare, quando premo il button(dove abbiamo specificato il type="submit") verrà eseguito il form --}}
<form method="post" action="{{ route('admin.posts.update', ['post'=> $post->id])}}">

    @csrf
    @method('PUT')
    {{-- andiamo a specificare il metodo che effettivamente utilizzeremo ovvero PUT --}}
    <div>
        <label>Titolo</label>
        {{-- ci prendiamo il value iniziale cosi da poter visualizzare dove dobbiamo applicare le eventuali modifiche  --}}
        <input type="text" name="title" value="{{ old('title',$post->title)}}">
        {{-- se non è stato inserito alcun valore visualizzo  $post->title, in caso contrario visualizzo l'ultimo valore inserito--}}

        {{-- visualizzo l'errore sotto l'input --}}
        @error ('title')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
    </div>
    <div>
        <label>Descrizione</label>
        <textarea name="description" rows="8" cols="80">{{ old('description',$post->description)}}</textarea>

        {{-- visualizzo l'errore sotto l'input --}}
        @error ('description')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
    </div>
    <div>
        <label>Seleziona categoria:</label>
        <select class="" name="category_id">
            <option value="">-- seleziona categoria --</option>
            @foreach ($categories as $category)
                {{-- se il valore della categoria corrente ($category->id) è uguale alla categoria del post($post->category_id) allora lo seleziono(selected=selected) --}}
                <option value="{{$category->id}}"
                {{-- se il valore è stato gia modificato confronto il primo parametro di old('category_id', $post->category_id) con  l'attuale $category->id, se non ancora modificato confronto il secondo parametro con l'attuale $category->id--}}
                {{$category->id == old('category_id', $post->category_id) ? 'selected=selected' : '' }}
                >

                    {{$category->name}}

                </option>

            @endforeach
        </select>
        {{-- visualizzo l'errore sotto l'input --}}
        @error ('category_id')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
    </div>
    <div>
        <label>Seleziona i tag:</label>
            @foreach ($tags as $tag)
                {{-- quando premo il button passo al mio database un array di tag (name="tags[]") --}}

                {{-- se la compilazione dell'input presenta errori --}}
                @if($errors->any())
                    <input type="checkbox" name="tags[]" value="{{$tag->id}}"
                    {{-- se il seguente tag ($tag->id) è presente nell'array 'tags' o [] (se inviato il form o meno )  allora lo seleziono --}}
                    {{ in_array($tag->id, old('tags', [])) ? 'checked=checked' : ''}}>
                @else
                    {{-- il ternario verifica che la checkbox con il tag corrente sia contenuta all'interno dei miei tag, se si la seleziona '(checked=checked )' --}}
                    <input type="checkbox" name="tags[]" value="{{$tag->id}}"
                    {{$post->tags->contains($tag)?'checked=checked':''}}>
                @endif
                <label for="">{{$tag->name}}</label>
            @endforeach
            {{-- visualizzo l'errore sotto l'input --}}
            @error ('tags')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
    </div>
    <div>
        {{-- cambiato da type="button" a type="submit" --}}
        <button type="submit" name="button">
            Salva
        </button>
    </div>

</form>
</div>
@endsection
