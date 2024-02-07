@extends('admin::layouts.guest')

@section('body_class', 'page-auth')

@section('content')
    <div class="auth-content">
        <form action="{{ route('admin.auth.password.update') }}" method="POST">
            @csrf
            <div class="auth-card">
                <div class="mb-4 fs-4 border-bottom pb-2">
                    {{ __('Reset password') }}
                </div>
                <input type="hidden" name="token" id="token" value="{{ $token }}">
                <div class="mb-3">
                    <x-bs.form-label for="email" required>{{ __('Email') }}</x-bs.form-label>
                    <x-bs.form-input type="email" name="email" value="{{ $email }}"/>
                    <x-bs.form-error name="email"/>
                </div>
                <div class="mb-3">
                    <x-bs.form-label for="password" required>{{ __('New password') }}</x-bs.form-label>
                    <x-bs.form-input type="password" name="password"/>
                    <x-bs.form-error name="password"/>
                </div>
                <div class="mb-3">
                    <x-bs.form-label for="password_confirmation" required>
                        {{ __('Confirm new password') }}
                    </x-bs.form-label>
                    <x-bs.form-input type="password" name="password_confirmation"/>
                    <x-bs.form-error name="password_confirmation"/>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    <a href="{{ route('admin.auth.login') }}" class="text-decoration-none">
                        {{ __('Sign in') }}
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection
