<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | {{ config('app.name') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />

</head>

<body>
    <div class="min-h-screen bg-gray-50 flex items-center justify-center p-6">
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script-code')
    <script>
        Alpine.start()
    </script>
</body>

</html>
