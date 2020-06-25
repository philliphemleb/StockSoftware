@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid">

        <div class="container">
            <h1 class="display-4">{{ $item->name }}</h1>
            <p class="lead">{{ $item->description }}</p>

            @foreach ($item->tags as $tag)
                <x-itemEditBadge>{{ $tag->name }}</x-itemEditBadge>
            @endforeach

            <hr class="my-4">
            <p>ID: {{ $item->id }} | <?php /** @var  \App\Item $item */echo __('item.created_by', ['name' => $item->user->name]); ?></p>
            @foreach ($item->categories as $category)
                <x-itemEditBadge>{{ $category->name }}</x-itemEditBadge>
            @endforeach
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
        <div class="form-group">
            <label for="itemTagsInput">{{ __('item.add_tags') }}</label>
            <input type="text" class="form-control" id="itemTagsInput" name="tags" placeholder="{{ __('item.separate_tags') }}">
        </div>
        <div class="form-group">
            <label for="itemDeleteTagsInput">{{ __('item.delete_tags') }}</label>
            <input type="text" class="form-control" id="itemDeleteTagsInput" name="deleteTags" placeholder="{{ __('item.separate_tags') }}">
        </div>
        <div class="form-group">
            <label for="itemCategoriesInput">{{ __('item.add_categories') }}</label>
            <input type="text" class="form-control" id="itemCategoriesInput" name="categories" placeholder="{{ __('item.separate_categories') }}">
        </div>
        <div class="form-group">
            <label for="itemDeleteCategoriesInput">{{ __('item.delete_categories') }}</label>
            <input type="text" class="form-control" id="itemDeleteCategoriesInput" name="deleteCategories" placeholder="{{ __('item.separate_categories') }}">
        </div>

        <button type="submit" class="btn btn-primary">{{ __('item.submit') }}</button>
    </form>
@endsection
