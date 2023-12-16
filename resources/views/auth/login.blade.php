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
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input type="email" class="form-control" name="email" id="email"/>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input type="password" class="form-control" name="password" id="password"/>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="remember" id="remember">
                        <label class="form-check-label" for="remember">
                            {{ __('Remember me') }}
                        </label>
                    </div>
                </div>
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
