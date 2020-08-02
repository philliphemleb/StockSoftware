@extends('app')

@section('content')
    <search route="{{ route('item.index') }}" placeholder="{{ __('item.search_placeholder') }}"></search>

    <div class="grid grid-cols-3">
        @foreach ($itemCollection as $item)
            <item-card :item="{{ $item }}" :categories="{{ json_encode($item->categories()) }}"></item-card>
        @endforeach
    </div>
@endsection
