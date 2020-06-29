@extends('app')

@section('content')
    <div id="item-index" class="mb-20">

        <search route="{{ route('item.index') }}" placeholder="{{ __('item.search_placeholder') }}"></search>

        <table-component :header="{{ json_encode([ __('item.name'), __('item.amount'), __('item.action') ]) }}">
            @foreach($itemCollection as $item)
                <table-item
                    :items="{{ json_encode([ $item->name, $item->amount ]) }}"
                    html-row="
                    <div class='flex justify-center'>
                        <a href='{{ route('item.edit', $item->id) }}' class='bg-gray-300 hover:bg-blue-500 text-black font-bold py-2 px-4 rounded-l far fa-eye'></a>
                        <form action='{{ route('item.destroy', $item->id) }}' method='POST'>
                            <input type='hidden' name='_method' value='DELETE'>
                            <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                            <button role='submit' class='bg-gray-900 hover:bg-red-300 text-red-500 font-bold py-2 px-4 rounded-r far fa-trash'></a>
                        </form>
                    </div>">
                </table-item>
            @endforeach
        </table-component>
    </div>
@endsection
