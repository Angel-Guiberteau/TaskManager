<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>
        @include('components.css')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body>
        @include('components.nav')

        <div class="container mt-5 pt-4">
            @yield('content')
        </div>
        
        @include('components.footer')
        @include('components.js')
    </body>
</html>