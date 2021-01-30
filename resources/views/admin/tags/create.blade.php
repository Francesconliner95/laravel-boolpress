@extends('layouts.app')

@section('content')
<div class="container">
    @include('admin/navbar')
    <h1>Aggiuni Nuovo Tag</h1>

{{-- creiamo un form inizialmente inseriamo il metodo post('in quanto il from accetta solo i metodi post e get') e poi andremo a specificare attraveso @method('PUT') il metodo che effettivamente utilizzeremo ovvero PUT, successivamente con action andiamo a specificare a quale rotta si deve collegare e ci passiamo il parametro id dell'oggetto corrente che stiamo andando a modificare, quando premo il button(dove abbiamo specificato il type="submit") verrà eseguito il form --}}
<form method="post" action="{{ route('admin.tags.store')}}">

    @csrf
    {{-- andiamo a specificare il metodo che effettivamente utilizzeremo ovvero PUT --}}
    <div>
        <label>Nome Tag</label>
        {{-- ci prendiamo il value iniziale cosi da poter visualizzare dove dobbiamo applicare le eventuali modifiche  --}}
        <input type="text" name="name" value="">
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
