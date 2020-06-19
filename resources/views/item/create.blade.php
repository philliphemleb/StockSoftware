@extends('layouts.app')

@section('content')
    <h3>@lang('item.creation') <span class="badge badge-secondary">@lang('item.item')</span></h3>

    <form action="{{ route('item.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="itemNameInput">{{ __('item.name') }}</label>
            <input type="text" class="form-control" id="itemNameInput" name="name">
        </div>
        <div class="form-group">
            <label for="itemDescriptionInput">{{ __('item.description') }}</label>
            <input type="text" class="form-control" id="itemDescriptionInput" name="description">
        </div>
        <div class="form-group">
            <label for="itemAmountInput">{{ __('item.amount') }}</label>
            <input type="number" class="form-control" id="itemAmountInput" name="amount">
        </div>
        <button type="submit" class="btn btn-primary">{{ __('item.create') }}</button>
    </form>
@endsection
