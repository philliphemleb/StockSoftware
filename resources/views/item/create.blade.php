@extends('app')

@section('content')
    <div class="text-center select-none mt-6 mx-6">
        <form action="{{ route('item.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label class="text-l" for="name">
                    {{ __('item.name') }}
                </label>
                <input id="name" name="name" type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 leading-tight transition ease-in duration-150 transform focus:bg-white focus:shadow focus:scale-105" placeholder="{{ __('item.name_placeholder') }}">
            </div>

            <div class="mb-6">
                <label class="text-l" for="description">
                    {{ __('item.description') }}
                </label>
                <input id="description" name="description" type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 leading-tight transition ease-in duration-150 transform focus:bg-white focus:shadow focus:scale-105" placeholder="{{ __('item.description_placeholder') }}">
            </div>

            <div class="mb-6">
                <label class="text-l" for="amount">
                    {{ __('item.amount') }}
                </label>
                <input id="amount" name="amount" type="number" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 leading-tight transition ease-in duration-150 transform focus:bg-white focus:shadow focus:scale-105" placeholder="{{ __('item.amount_placeholder') }}">
            </div>

            <div class="mb-6">
                <label class="text-l" for="categories">
                    {{ __('item.categories') }}
                </label>
                <input id="categories" name="categories" type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 leading-tight transition ease-in duration-150 transform focus:bg-white focus:shadow focus:scale-105" placeholder="{{ __('item.categories_placeholder') }}">
            </div>

            <div class="mb-6">
                <label class="text-l" for="tags">
                    {{ __('item.tags') }}
                </label>
                <input id="tags" name="tags" type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 leading-tight transition ease-in duration-150 transform focus:bg-white focus:shadow focus:scale-105" placeholder="{{ __('item.tags_placeholder') }}">
            </div>

            <button type="submit" class="w-full border-2 border-blue-700 bg-blue-500 text-white font-bold py-2 px-6 rounded hover:bg-blue-700 hover:shadow">{{ __('button.submit') }}</button>
        </form>
    </div>
@endsection
