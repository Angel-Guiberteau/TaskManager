{{-- General scripts --}}

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>


{{-- Specific scripts --}}

{{-- Identify the route and import the exclusive js for the view --}}

@if(Route::currentRouteName() === 'admin')

    <script src="{{ asset('js/admin.js') }}"></script>

@elseif(Route::currentRouteName() === 'user')

    <script src="{{ asset('js/user.js') }}"></script>

@elseif(Route::currentRouteName() === 'history')

    <script src="{{ asset('js/history.js') }}"></script>

@elseif(Route::currentRouteName() === 'home')

    <script src="{{ asset('js/home.js') }}"></script>

@endif