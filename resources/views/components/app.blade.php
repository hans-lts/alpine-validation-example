@props(['title' => null])
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Alpine validation</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">

    @livewireScripts
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('message.processed', (message, component) => {
                let errors = message.response.serverMemo.errors
                component.el.dispatchEvent(new CustomEvent('validation-error', {
                    detail: errors
                }))
            })
        });
    </script>
</head>
<body>

@if($title)
    <nav class="container">
        <div class="grid" style="width: 100%">
            <ul>
                <li>
                    <div style="font-size: 2rem; color: #ffffff; font-weight: 600">{{ $title }}</div>
                </li>
            </ul>
            <ul>
                <li>Examples:</li>
                <li><a href="/" @class(['selected' => request()->path() === '/'])>Local component</a></li>
                <li><a href="/global" @class(['selected' => request()->path() === 'global'])>Global component</a></li>
            </ul>
        </div>
    </nav>
@endif
<main class="container">
    {{ $slot }}
</main>
</body>
</html>
