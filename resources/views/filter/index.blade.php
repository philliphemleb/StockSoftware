@extends('layouts.app')

@section('content')
    <a class="btn btn-primary btn-block mb-5" href="{{ route('filter.create') }}" role="button">{{ __('filter.create') }}</a>
    <x-list-group>
        @foreach ($filterCollection as $filter)
            <x-list-group.filter href="{{ route('filter.show', $filter->id) }}">{{ $filter->name }}</x-list-group.filter>
        @endforeach
    </x-list-group>
@endsection
