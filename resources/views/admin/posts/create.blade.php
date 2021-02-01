@extends('layouts.app')

@section('content')
<div class="container">
    @include('admin/navbar')
    <h1>Aggiungi nuovo Post</h1>

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
<form method="post" action="{{ route('admin.posts.store')}}">

    @csrf
    {{-- andiamo a specificare il metodo che effettivamente utilizzeremo ovvero PUT --}}
    <div>
        <label>Titolo</label>
         {{-- impostiamo il value {{ old('title')}}, in quanto la funzione old() in caso di errore di input quando la pagina viene ricaricata mantiene il valore precedente cosi non devo reinserirlo --}}
        <input type="text" name="title" value="{{ old('title')}}">
    </div>
    <div>
        <label>Descrizione</label>
        <textarea name="description" rows="8" cols="80">{{ old('descriprion')}}</textarea>
    </div>
    <div>
        <label>Categorie</label>
        <select class="" name="category_id">
            <option value="">-- seleziona categoria --</option>
            @foreach ($categories as $category)
                <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected=selected' : '' }}>{{$category->name}}</option>
                {{-- {{ old('category_id') == $category->id ? 'selected=selected' : '' }}  se la category_id inserita in precedenza è uguale all'id ($category->id) ciclato allora la seleziono--}}
            @endforeach
        </select>
    </div>
    <div>
        <label>Seleziona i tag:</label>
            @foreach ($tags as $tag)
                {{-- quando premo il button passo al mio database un array di tag (name="tags[]") --}}
                <input type="checkbox" name="tags[]" value="{{$tag->id}}" {{in_array($tag->id, old('tags', [])) ? 'checked=checked':''}}>
                {{-- {{con la funzione in_array andiamo a vedere se esiste un elemento in un array, il tag corrente ($tag->id) è presente all'interno dell'array  'tags' (old('tags', [])) se si lo seleziono--}}
                {{-- la funzione old('tags', []) come primo parametro si passa l'ultimo valore inserito nell'input , e come secondo parametro il valore nel caso in cui non è ancora stato inserito alcun valore quindi nel nostro caso un array vuoto [] --}}
                <label for="">{{$tag->name}}</label>
            @endforeach
        </select>
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
