@props(['title' => null])
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Alpine validation</title>

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">

    @livewireScriptConfig
</head>
<body>

@if($title)
    <nav class="container">
        <div class="grid" style="width: 100%;">
            <ul>
                <li>
                    <div style="font-size: 2rem; color: #ffffff; font-weight: 600">{{ $title }}</div>
                </li>
            </ul>
        </div>
    </nav>
@endif
<main class="container">
    {{ $slot }}
</main>
</body>
</html>
