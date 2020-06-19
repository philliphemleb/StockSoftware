@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <h1 class="display-4">{{ __('home.welcome') }}, {{ $username }}</h1>
        <p class="lead">{{ $email }}</p>
        <a class="btn btn-primary btn-lg" href="{{ route('user.index') }}" role="button">{{ __('home.to_account') }}</a>

        <a href="{{ route('logout') }}" class="btn btn-primary btn-lg"
           onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">{{ __('home.logout') }}</a>
        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
@endsection
