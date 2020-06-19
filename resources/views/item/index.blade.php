@extends('layouts.app')

@section('content')
    <x-list-group>
        @foreach ($itemCollection as $item)
            <x-list-group.item href="{{ route('item.show', $item->id) }}">{{ $item->name }}</x-list-group.item>
        @endforeach
    </x-list-group>
@endsection
