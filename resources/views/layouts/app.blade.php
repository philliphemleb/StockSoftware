<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'StockSoftware') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @if (Session()->has('status_messages') || $errors->any())
            <div style="position: absolute; top: 5rem; right: 1rem; z-index: 9999">
                @if (Session()->has('status_messages'))
                    @foreach (Session()->get('status_messages') as $status_message)
                        <x-notification>{{ $status_message }}</x-notification>
                    @endforeach
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <x-notification>{{ $error }}</x-notification>
                    @endforeach
                @endif
            </div>
        @endif

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'StockSoftware') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('item.index') }}">{{ __('item.inventory') }}</a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <a class="btn btn-outline-dark mr-1" href="{{ route('filter.index') }}" role="button">{{ __('filter.menu') }}</a>
                        <a class="btn btn-primary" href="{{ route('item.create') }}" role="button">{{ __('item.store') }}</a>
                    </form>
                </div>
            </div>
        </nav>

        <main class="py-4 container">
            @yield('content')
        </main>
    </div>
</body>
</html>
