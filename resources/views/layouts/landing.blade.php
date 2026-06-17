<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="description" content="Secure authentication for Yora Arki - modern workspace for teams">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
</head>
<body class="min-h-screen bg-white">
    <main>
        {{ $slot }}
    </main>
    @livewireScripts
</body>
</html>