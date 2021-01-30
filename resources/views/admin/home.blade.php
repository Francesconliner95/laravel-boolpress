@extends('layouts.app')

@section('content')
<div class="container">
    @include('admin/navbar')
    {{-- <ul>
        <li>
            <a href="{{route('admin.index')}}">Dashboard</a>
        </li>
        <li>
            <a href="{{route('admin.posts.index')}}">Posts</a>
        </li>
    </ul> --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
