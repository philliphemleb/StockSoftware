@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid">

        <div class="container">
            <h1 class="display-4">{{ $filter->name }}</h1>
            <p class="lead">{{ $filter->description }}</p>
            <hr class="my-4">
            <p>ID: {{ $filter->id }}</p>
        </div>
    </div>

    <a href="{{ route('filter.edit', $filter->id) }}" class="btn btn-outline-primary btn-lg btn-block">{{ __('filter.edit') }}</a>
    <a href="{{ route('filter.destroy', $filter->id) }}" class="btn btn-outline-danger btn-lg btn-block mb-5"
       onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">{{ __('filter.delete') }}</a>
    <form id="frm-logout" action="{{ route('filter.destroy', $filter->id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <form action="{{ route('filter.update', $filter->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <input type="hidden" class="form-control" id="filterNameInput" value="{{ $filter->name }}" name="name">
            <input type="hidden" class="form-control" id="filterDescriptionInput" value="{{ $filter->description }}" name="description">
        </div>
        <button type="submit" class="btn btn-primary">{{ __('filter.submit') }}</button>
    </form>
@endsection
