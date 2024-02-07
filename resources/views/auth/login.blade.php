@extends('admin::layouts.guest')

@section('body_class', 'page-auth')

@section('content')
    <div class="auth-content">
        <form action="{{ route('admin.auth.login') }}" method="POST">
            @csrf
            <div class="auth-card">
                <div class="mb-4 fs-4 border-bottom pb-2">
                    {{ __('Authentication') }}
                </div>

                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <x-bs.form-group>
                    <x-bs.form-label for="email" required>{{ __('Email') }}</x-bs.form-label>
                    <x-bs.form-input name="email" value="{{ old('email') }}"/>
                    <x-bs.form-error name="email"/>
                </x-bs.form-group>

                <x-bs.form-group>
                    <x-bs.form-label for="password" required>{{ __('Password') }}</x-bs.form-label>
                    <x-bs.form-input type="password" name="password"/>
                    <x-bs.form-error name="password"/>
                </x-bs.form-group>

                <x-bs.form-group>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="remember" id="remember">
                        <label class="form-check-label" for="remember">
                            {{ __('Remember me') }}
                        </label>
                    </div>
                </x-bs.form-group>

                <div class="d-flex align-items-center justify-content-between">
                    <button type="submit" class="btn btn-primary">{{ __('Sign in') }}</button>
                    <a href="{{ route('admin.auth.password.request') }}" class="text-decoration-none">
                        {{ __('Reset password') }}
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection
