@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifica</h1>

{{-- creiamo un form inizialmente inseriamo il metodo post('in quanto il from accetta solo i metodi post e get') e poi andremo a specificare attraveso @method('PUT') il metodo che effettivamente utilizzeremo ovvero PUT, successivamente con action andiamo a specificare a quale rotta si deve collegare e ci passiamo il parametro id dell'oggetto corrente che stiamo andando a modificare, quando premo il button(dove abbiamo specificato il type="submit") verrà eseguito il form --}}
<form method="post" action="{{ route('admin.posts.store')}}">

    @csrf
    {{-- andiamo a specificare il metodo che effettivamente utilizzeremo ovvero PUT --}}
    <div>
        <label>Titolo</label>
        {{-- ci prendiamo il value iniziale cosi da poter visualizzare dove dobbiamo applicare le eventuali modifiche  --}}
        <input type="text" name="title" value="">
    </div>
    <div>
        <label>Descrizione</label>
        <textarea name="description" rows="8" cols="80"></textarea>
    </div>
    <div>
        <label>Categorie</label>
        <select class="" name="category_id">
            <option value="">-- seleziona categoria --</option>
            @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label>Seleziona i tag:</label>
            @foreach ($tags as $tag)
                <input type="checkbox" name="tags[]" value="{{$tag->id}}">
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
