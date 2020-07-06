@extends('app')

@section('content')
    <div class="text-center select-none mt-6 mx-6">
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label class="text-l" for="name">
                    {{ __('auth.username') }}
                </label>
                <input id="name" name="name" type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 leading-tight transition ease-in duration-150 transform focus:bg-white focus:shadow focus:scale-105" placeholder="{{ __('auth.username_placeholder') }}">
            </div>

            <div class="mb-6">
                <label class="text-l" for="password">
                    {{ __('auth.password') }}
                </label>
                <input id="password" name="password" type="password" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 leading-tight transition ease-in duration-150 transform focus:bg-white focus:shadow focus:scale-105" placeholder="{{ __('auth.password_placeholder') }}">
            </div>

            <div class="mb-6 flex flex-row justify-left">
                <div>
                    <label class="text-gray-500 font-bold">
                        <input class="mr-2 leading-tight" type="checkbox" id="remember" name="remember">
                        <span class="text-sm align-top">
                            {{ __('auth.remember_me') }}
                        </span>
                    </label>
                </div>

                <div class="ml-auto italic">
                    <a href="{{ route('password.request') }}">{{ __('auth.forgot_password?') }}</a>
                </div>
            </div>

            <button type="submit" class="w-full border-2 border-blue-700 bg-blue-500 text-white font-bold py-2 px-6 rounded hover:bg-blue-700 hover:shadow">{{ __('button.submit') }}</button>
        </form>
    </div>
@endsection
