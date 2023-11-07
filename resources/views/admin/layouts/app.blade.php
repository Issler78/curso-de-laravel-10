<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ config('app.name') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <section class="container px-4 mx-auto">

        @yield('header')

        <div>
            @yield('content')
        </div>
    </section>
</body>
</html>