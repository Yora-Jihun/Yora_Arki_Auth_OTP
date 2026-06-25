<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth</title>
    <meta name="theme-color" content="#0A5FFF">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <meta name="description" content="Secure authentication for Yora Arki - register or sign in to access your account">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    {{-- <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script> --}}
</head>
<body class="min-h-screen bg-slate-100 p-4 sm:p-6">
    <main class="mx-auto flex min-h-[calc(100vh-3rem)] w-full max-w-7xl items-center justify-center transition-all duration-300 ease-out" wire:transition>
        {{ $slot }}
    </main>
    @livewireScripts
</body>
</html>