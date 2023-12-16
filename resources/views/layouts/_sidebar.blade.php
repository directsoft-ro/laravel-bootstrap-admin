<aside id="main-sidebar">
    <div class="sidebar-back"></div>
    <div class="sidebar-document">
        <div class="sidebar-header">
            <a href="{{ route('admin.home') }}" role="button" class="logo">
                {{ config('app.name') }}
            </a>
        </div>
        <div class="sidebar-body">
            <ul class="sidebar-menu">
                <li class="{{ \Request::routeIs('admin.home') ? 'active' : '' }}">
                    <a href="{{ route('admin.home.index') }}">
                        <i class="fa-solid fa-dashboard icon"></i>
                        {{ __('Dashboard') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
