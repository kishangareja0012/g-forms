<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | {{ config('app.name') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />

</head>

<body x-data>

    @include('_layouts.header')

    <main class="pt-[68px] transition-all">
        <div class="mx-auto max-w-screen-2xl space-y-6 px-6 py-6 sm:px-12">
            @yield('content')
        </div>
    </main>

    @yield('modal')

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script-code')
    <script>
        Alpine.start()
    </script>
</body>

</html>
