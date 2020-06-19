@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid">

        <div class="container">
            <h1 class="display-4">{{ $item->name }}</h1>
            <p class="lead">{{ $item->description }}</p>
            <hr class="my-4">
            <p>ID: {{ $item->id }} @if($created_by !== null) | <?php echo __('item.last_edited', ['name' => $created_by->name]); ?> @endif</p>
        </div>
    </div>

    <a href="{{ route('item.edit', $item->id) }}" class="btn btn-outline-primary btn-lg btn-block">{{ __('item.edit') }}</a>
    <a href="{{ route('item.destroy', $item->id) }}" class="btn btn-outline-danger btn-lg btn-block mb-5"
       onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">{{ __('item.delete') }}</a>
    <form id="frm-logout" action="{{ route('item.destroy', $item->id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <form action="{{ route('item.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <input type="hidden" class="form-control" id="itemNameInput" value="{{ $item->name }}" name="name">
            <input type="hidden" class="form-control" id="itemDescriptionInput" value="{{ $item->description }}" name="description">

            <label for="itemAmountInput">{{ __('item.amount') }}</label>
            <input type="number" class="form-control" id="itemAmountInput" value="{{ $item->amount }}" name="amount">
        </div>
        <button type="submit" class="btn btn-primary">{{ __('item.submit') }}</button>
    </form>
@endsection
