<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $description ?? 'NaturFreunde Traunreut e.V. – Wandern, Umwelt, Gemeinschaft seit 1895.' }}">
    <title>{{ isset($title) ? $title . ' – ' : '' }}NaturFreunde Traunreut e.V.</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Nunito:wght@300;400;500;600&display=swap" rel="stylesheet">

    {{-- Vite / Tailwind --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head')
</head>
<body class="bg-cream text-gray-800 font-nunito antialiased overflow-x-hidden">

    {{-- Navigation --}}
    @include('components.navbar')

    {{-- Page content --}}
    <main>
        {{ $slot }}
    </main>

    {{-- Footer --}}
    @include('components.footer')

    {{-- Lightbox (shared across pages) --}}
    @include('components.lightbox')

    @stack('scripts')
</body>
</html>
