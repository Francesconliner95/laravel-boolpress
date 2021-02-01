@extends('layouts.app')

@section('content')
<div class="container">
    <dl>
        <dt>Nome</dt>
        <dd>{{Auth::user()->name}}</dd>
        <dt>Email</dt>
        <dd>{{Auth::user()->email}}</dd>
        <dt>API token</dt>
        {{-- se esiste il token --}}
        @if (Auth::user()->api_token)
            {{-- lo stampo --}}
            <dd>{{Auth::user()->api_token}}</dd>
        @else
            {{-- altrimenti lo genero atraverso la rotta  route('admin.generate_token')--}}
            <form action="{{ route('admin.generate_token')}}" method="post">
                @csrf
                <button type="submit" name="button">
                    Genera API Token
                </button>
            </form>
        @endif

    </dl>
</div>
@endsection
