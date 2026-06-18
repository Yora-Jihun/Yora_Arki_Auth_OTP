<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <meta name="description" content="Yora Arki Dashboard - Manage your account and settings">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
</head>
<body class="min-h-screen bg-gray-100">
    <div class="flex h-screen">
        @include('livewire.dashboard.partials.sidebar', ['active' => 'dashboard'])
        <main id="mainContent" class="flex-1 overflow-y-auto bg-[#F8F9FB] transition-all duration-300" style="margin-left: 250px;">
            @include('livewire.dashboard.partials.headnavbar')
            <div class="p-8 min-h-full">
                {{ $slot }}
            </div>
        </main>
    </div>
    @livewireScripts
</body>
</html>
