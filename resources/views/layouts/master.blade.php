<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield("title") | Tradivas</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iconic/css/open-iconic-bootstrap.min.css') }}">
    
    @include('layouts.variables')
    
    @stack('variables')

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    @stack('styles')
</head>
<body>
    @include('layouts.navigation')
    @yield('slide-show')
    <main class="container">
        <div class="row">
            <div class="col">
                <div class="tradivas-ruler"></div>
                @yield('content')
                <div class="tradivas-ruler"></div>
                <footer class="tradivas-footer">
                    @include('layouts.footer')
                </footer>
            </div>
        </div>
    </main>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    @stack('scripts')
</body>
</html>