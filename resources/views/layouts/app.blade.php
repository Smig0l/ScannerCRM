<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Scanner CRM</title>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    @yield('scripts')

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">


</head>
<body>
    <div id="app">
        <main class="py-4">
            <div class="container">
                @yield('headers')
                
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>