@extends('admin::layouts.base')

@section('base_content')
    <div id="app">
        @include('admin::layouts._header')
        @include('admin::layouts._sidebar')
        <main id="main-content" class="py-3 px-2">
            <div class="container">
                @yield('content')
            </div>
        </main>
        @include('admin::layouts._footer')
    </div>
@endsection