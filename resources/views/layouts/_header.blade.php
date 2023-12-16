<header id="main-header">
    <button type="button" class="btn btn-white btn-toggle-sidebar">
        <i class="fa-solid fa-outdent"></i>
    </button>

    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ config('app.url') }}" target="_blank" data-bs-toggle="tooltip"
               data-bs-placement="bottom" data-bs-title="{{ __('Website') }}">
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
            </a>
        </li>
        <li class="nav-item">
            <div class="dropdown user-dropdown">
                <button class="btn btn-white dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                    {{ auth()->user()->getName() }}
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="#">
                            {{ __('Edit profile') }}
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            {{ __('Change password') }}
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('admin.auth.logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item" type="submit">
                                {{ __('Sign out') }}
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</header>
