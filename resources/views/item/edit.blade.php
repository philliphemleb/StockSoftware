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

    <form action="{{ route('item.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="itemNameInput">{{ __('item.name') }}</label>
            <input type="text" class="form-control" id="itemNameInput" value="{{ $item->name }}" name="name">
        </div>
        <div class="form-group">
            <label for="itemDescriptionInput">{{ __('item.description') }}</label>
            <input type="text" class="form-control" id="itemDescriptionInput" value="{{ $item->description }}" name="description">
        </div>
        <div class="form-group">
            <label for="itemAmountInput">{{ __('item.amount') }}</label>
            <input type="number" class="form-control" id="itemAmountInput" value="{{ $item->amount }}" name="amount">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
