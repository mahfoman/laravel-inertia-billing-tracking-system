

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Tailwind CSS -->
    @vite('resources/css/app.css')

    <!-- Inertia Head -->
    @inertiaHead
</head>
<body class="flex flex-col min-h-screen">

<!-- Header Section -->
<header class="bg-blue-600 text-white p-4">
    <nav class="max-w-4xl mx-auto flex justify-between">
        <a href="#" class="text-lg font-semibold">Billing Tracking</a>
        <ul class="flex space-x-4">
            <li><a href="#" class="hover:underline">Home</a></li>
            <li><a href="#" class="hover:underline">About</a></li>
            <li><a href="#" class="hover:underline">Contact</a></li>
        </ul>
    </nav>
</header>

@inertia

<!-- Footer Section -->
<footer class="bg-blue-600 text-white p-4">
    <div class="max-w-4xl mx-auto text-center">
        <p>&copy; {{ now()->year }} Billing Tracking. All rights reserved.</p>
    </div>
</footer>
<!-- Inertia Scripts -->
@vite('resources/js/app.js')
</body>
</html>
