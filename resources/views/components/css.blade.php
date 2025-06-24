{{-- <link rel="stylesheet" href="./resources/css/app.css"> --}}


{{-- General styles --}}

<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

{{-- Specific styles --}}

@if(Route::currentRouteName() === 'home')

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

@endif