@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <h1 class="display-4">{{ __('user.welcome') }}, {{ $username }}</h1>
        <p class="lead">{{ __('user.personal_account_site') }}</p>
        <a class="btn btn-primary btn-lg" href="{{ route('user.edit', $id) }}" role="button">{{ __('user.change_account_data') }}</a>
    </div>
@endsection
