@extends('admin::layouts.guest')

@section('body_class', 'page-auth')

@section('content')
    <div class="auth-content">
        <form action="{{ route('admin.auth.password.email') }}" method="POST">
            @csrf
            <div class="auth-card">
                <div class="mb-4 fs-4 border-bottom pb-2">
                    {{ __('Reset password') }}
                </div>
                @if(session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                <x-bs.form-group>
                    <x-bs.form-label for="email" required>{{ __('Email') }}</x-bs.form-label>
                    <x-bs.form-input name="email" value="{{ old('email') }}"/>
                    <x-bs.form-error name="email"/>
                </x-bs.form-group>
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
