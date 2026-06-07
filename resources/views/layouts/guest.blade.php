<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Bulk Bazaar - Access Portal</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script>
            if (localStorage.getItem('theme') === 'light' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: light)').matches)) {
                document.documentElement.classList.add('light');
            } else {
                document.documentElement.classList.remove('light');
            }
        </script>
    </head>
    <body class="bg-bgDark text-textPrimary font-sans antialiased min-h-screen flex flex-col justify-center items-center py-6 px-4">
        
        <!-- Glowing bg element -->
        <div class="absolute top-[-200px] left-[-200px] w-96 h-96 bg-glow-indigo rounded-full blur-3xl opacity-50"></div>

        <div class="w-full max-w-md relative z-10 space-y-6">
            <!-- Brand Logo -->
            <div class="text-center flex justify-center">
                <a href="/" class="group flex flex-col items-center">
                    <img src="/logo.png" alt="Bulk Bazaar" class="h-28 w-auto object-contain transition-smooth group-hover:scale-[1.03]">
                </a>
            </div>

            <!-- Login / Register Card -->
            <div class="w-full bg-sidebarBg border border-cardBorder rounded-3xl p-8 shadow-2xl space-y-4">
                {{ $slot }}
            </div>

            <!-- Portal Footer -->
            <div class="text-center">
                <a href="/" class="text-xs text-textMuted hover:text-white transition-smooth">
                    ← Back to Storefront
                </a>
            </div>
        </div>
    </body>
</html>
