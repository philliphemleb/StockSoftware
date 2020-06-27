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
    <div id="app" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
        <div class="notification">
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
        </div>

        <navigation>
            <navigation-list-item route="{{ route('home') }}" text="{{ __('navigation.index') }}" icon="fas fa-home"></navigation-list-item>
            <navigation-list-item route="{{ route('home') }}" text="{{ __('navigation.admin') }}" icon="fas fa-sliders-h"></navigation-list-item>
            <navigation-list-item class="md:hidden" route="{{ route('logout') }}" text="{{ __('navigation.logout') }}" icon="fas fa-sliders-h"></navigation-list-item>
        </navigation>


        <!-- <main class="py-4 container">
            {{-- @yield('content') --}}
        </main> -->
    </div>
</body>
</html>
