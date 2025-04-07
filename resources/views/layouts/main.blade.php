<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @hasSection('meta')
        @yield('meta')
    @else
        <title>@yield('title', config('app.name', 'Cozy'))</title>
    @endif

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/'.$webInfo->site_favicon) }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('storage/'.$webInfo->site_favicon) }}" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @yield('styles')

    {!! $webInfo->header_script !!}

    @livewireStyles
</head>
<body class="font-[Inter] bg-white">
    <!-- Header -->
    @include('partials.header')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    {!! $webInfo->footer_script !!}

    @yield('scripts')
    @livewireScripts
</body>
</html> 
