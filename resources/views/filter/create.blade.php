@extends('layouts.app')

@section('content')
    <h3>{{ __('filter.creation') }} <span class="badge badge-secondary"> {{ __('filter.filter') }}</span></h3>

    <form action="{{ route('filter.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="filterNameInput">{{ __('filter.name') }}</label>
            <input type="text" class="form-control" id="filterNameInput" name="name">
        </div>
        <div class="form-group">
            <label for="filterDescriptionInput">{{ __('filter.description') }}</label>
            <input type="text" class="form-control" id="filterDescriptionInput" name="description">
        </div>
        <button type="submit" class="btn btn-primary btn-block">{{ __('filter.create') }}</button>
    </form>
@endsection
