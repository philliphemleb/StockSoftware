@extends('layouts.app')

@section('content')
    <form action="{{ route('item.index') }}" method="GET">
        <div class="form-group">
            <label for="search-input">{{ __('item.name') }}</label>
            <input type="search" class="form-control ds-input" id="search-input" placeholder="{{ __('index.search_placeholder') }}" name="search">
        </div>
    </form>

    <div class="mb-3"></div>

    <x-list-group>
        @foreach ($itemCollection as $item)
            <x-list-group.item href="{{ route('item.edit', $item->id) }}">{{ $item->name }}</x-list-group.item>
        @endforeach
    </x-list-group>
@endsection
