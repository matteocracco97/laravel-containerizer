<!DOCTYPE html>
<html lang="it" class="bg-zinc-950 text-zinc-200">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Laravel Containerizer' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <div class="min-h-screen flex flex-col">
        <nav class="border-b border-zinc-800 px-6 py-4 flex justify-between items-center bg-zinc-950/50 backdrop-blur-md sticky top-0 z-50">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
                    <span class="text-zinc-950 font-bold text-xl">L</span>
                </div>
                <span class="font-semibold tracking-tight">laravel-containerizer</span>
            </div>
            <div class="flex items-center gap-4 text-sm text-zinc-400">
                <a href="#" class="hover:text-white transition">Docs</a>
                <div class="w-8 h-8 rounded-full bg-zinc-800 border border-zinc-700"></div>
            </div>
        </nav>

        <main class="flex-1 max-w-5xl mx-auto w-full py-12 px-6">
            {{ $slot }}
        </main>
    </div>
</body>
</html>