@extends('layouts.app')

@section('content')
    <form action="{{ route('user.update', $id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="userNameInput">{{ __('user.edit_name') }}</label>
            <input type="text" class="form-control" id="userNameInput" value="{{ $username }}" name="name" disabled="disabled">
        </div>
        <div class="form-group">
            <label for="userEmailInput">{{ __('user.edit_email') }}</label>
            <input type="text" class="form-control" id="userEmailInput" value="{{ $email }}" name="email">
        </div>
        <div class="form-group">
            <label for="userPasswordInput">{{ __('user.edit_password') }}</label>
            <input type="password" class="form-control" id="userPasswordInput" placeholder="{{ __('user.edit_password_placeholder') }}" name="password">
        </div>
        <div class="form-group">
            <label for="userActualPasswordInput">{{ __('user.actual_password') }}</label>
            <input type="password" class="form-control" id="userActualPasswordInput" placeholder="{{ __('user.actual_password_placeholder') }}" name="actualPassword">
        </div>
        <button type="submit" class="btn btn-primary">{{ __('user.submit') }}</button>
    </form>
@endsection
