<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 p-4 sm:p-6">
    <div class="mx-auto flex min-h-[calc(100vh-3rem)] w-full max-w-7xl items-center justify-center transition-all duration-300 ease-out" wire:transition>
        {{ $slot }}
    </div>
</body>
</html>
