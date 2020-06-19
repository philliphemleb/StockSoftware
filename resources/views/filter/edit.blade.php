@extends('layouts.app')

@section('content')
    <form action="{{ route('filter.update', $filter->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="filterNameInput">{{ __('filter.name') }}</label>
            <input type="text" class="form-control" id="filterNameInput" value="{{ $filter->name }}" name="name">
        </div>
        <div class="form-group">
            <label for="filterDescriptionInput">{{ __('filter.description') }}</label>
            <input type="text" class="form-control" id="filterDescriptionInput" value="{{ $filter->description }}" name="description">
        </div>
        <button type="submit" class="btn btn-primary">{{ __('filter.submit') }}</button>
    </form>
@endsection
