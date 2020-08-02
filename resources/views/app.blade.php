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
    <div id="app" class="md:grid md:grid-cols-4 lg:grid-cols-5">
        <notification-container>
            @if (Session()->has('status_messages'))
                @foreach (Session()->get('status_messages') as $status_message)
                    <notification-item title="{{ __('notification.title') }}" type="{{ $status_message['type'] }}">{{ $status_message['content'] }}</notification-item>
                @endforeach
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <notification-item title="{{ __('notification.title') }}" type="error">{{ $error }}</notification-item>
                @endforeach
            @endif
        </notification-container>

        <div id="navigation">
            <navigation>
                <navigation-list-item
                    route="{{ route('home') }}"
                    icon="fas fa-home">{{ __('navigation.dashboard') }}
                </navigation-list-item>
                <navigation-list-item
                    route="{{ route('item.index') }}"
                    :hover_links="{{ json_encode([ [__('navigation.create_item'), route('item.create')] ]) }}"
                    icon="fas fa-boxes">{{ __('navigation.items') }}
                </navigation-list-item>
                <navigation-list-item class="md:hidden"
                                      route="{{ route('logout') }}"
                                      icon="fas fa-sign-out-alt">{{ __('navigation.logout') }}
                </navigation-list-item>
            </navigation>
        </div>

        <main class="md:col-start-2 md:col-end-5 mb-24">
            @yield('content')
        </main>
    </div>
</body>
</html>
