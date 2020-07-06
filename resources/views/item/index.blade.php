@extends('app')

@section('content')
    <div id="item-index" class="mb-20 mt-6 mx-6">

        <search route="{{ route('item.index') }}" placeholder="{{ __('item.search_placeholder') }}"></search>

        <table-component :header="{{ json_encode([ __('item.name'), __('item.amount'), __('item.action') ]) }}">
            @foreach($itemCollection as $item)
                <item-table-item
                    :rows="{{ json_encode([ $item->name, $item->amount ]) }}"
                    edit_route="{{ route('item.edit', $item->id) }}"
                    delete_route="{{ route('item.destroy', $item->id) }}"
                    csrf_token="{{ csrf_token() }}">
                </item-table-item>
            @endforeach
        </table-component>
    </div>
@endsection
