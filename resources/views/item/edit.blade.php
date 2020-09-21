@extends('app')

@section('content')
    <div class="bg-gray-300 shadow rounded text-center divide-y divide-gray-400">
        <div class="font-mono mt-1 mb-1">
            <p>{{ $item->name }}</p>
        </div>
        <div>
            <p class="mt-2">{Anzahl}: {{ $item->amount }}</p>
            <p class="my-4 mx-4">{{ $item->description }}</p>
            <p class="font-hairline">Zuletzt bearbeitet von Phillip</p>
        </div>
    </div>

    <div class="text-center select-none mt-6 mx-6">
        <form action="{{ route('item.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="text-l" for="name">
                    {{ __('item.name') }}
                </label>
                <input value="{{ $item->name }}" id="name" name="name" type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 leading-tight transition ease-in duration-150 transform focus:bg-white focus:shadow focus:scale-105" placeholder="{{ __('item.name_placeholder') }}">
            </div>

            <div class="mb-6">
                <label class="text-l" for="description">
                    {{ __('item.description') }}
                </label>
                <input value="{{ $item->description }}" id="description" name="description" type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 leading-tight transition ease-in duration-150 transform focus:bg-white focus:shadow focus:scale-105" placeholder="{{ __('item.description_placeholder') }}">
            </div>

            <div class="mb-6">
                <label class="text-l" for="amount">
                    {{ __('item.amount') }}
                </label>
                <input value="{{ $item->amount }}" id="amount" name="amount" type="number" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 leading-tight transition ease-in duration-150 transform focus:bg-white focus:shadow focus:scale-105" placeholder="{{ __('item.amount_placeholder') }}">
            </div>

            <button type="submit" class="w-full border-2 border-blue-700 bg-blue-500 text-white font-bold py-2 px-6 rounded hover:bg-blue-700 hover:shadow">{{ __('button.submit') }}</button>
        </form>
    </div>
@endsection
