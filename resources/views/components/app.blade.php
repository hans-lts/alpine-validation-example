@props(['title' => null])
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Alpine validation</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @livewireScripts
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
</head>
<body>

@if($title)
    <nav class="container" style="border-bottom: 1px solid;">
        <ul>
            <li>
                <div style="font-size: 2rem; color: #ffffff;">{{ $title }}</div>
            </li>
        </ul>
        <ul>
            <li>Examples:</li>
            <li><a href="/">Local component</a></li>
            <li><a href="/global">Global component</a></li>
        </ul>
    </nav>
@endif
<main class="container">
    {{ $slot }}
</main>
</body>
</html>
