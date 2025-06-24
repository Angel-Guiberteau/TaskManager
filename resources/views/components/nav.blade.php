<nav class="navbar navbar-expand-lg navbar-light bg-accent fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand fs-2 fw-bold" href="{{ route('home') }}">
            Task<span class="lighter">Manager</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav w-100 justify-content-around">
                <li class="nav-item fs-4">
                    <a class="nav-link {{ Route::currentRouteName() === 'admin' ? 'active' : '' }}" href="{{ route('admin') }}">Admin</a>
                </li>
                <li class="nav-item fs-4">
                    <a class="nav-link {{ Route::currentRouteName() === 'user' ? 'active' : '' }}" href="{{ route('user') }}">User </a>
                </li>
                <li class="nav-item fs-4">
                    <a class="nav-link {{ Route::currentRouteName() === 'history' ? 'active' : '' }}" href="{{ route('history') }}">History</a>
                </li>
            </ul>
        </div>
    </div>
</nav>