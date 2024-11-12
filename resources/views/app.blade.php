

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
<body class="flex flex-col min-h-screen bg-gray-100">

<!-- Header Section -->
<header class="bg-gray-600 text-white p-4">
    <nav class="max-w-4xl mx-auto flex justify-between">
        <a href="#" class="text-lg font-semibold">Billing Tracking</a>
        <ul class="flex space-x-4">
            <li><a href="#" class="hover:underline">Home</a></li>
            <li><a href="/companies" class="hover:underline">Companies</a></li>
            <li><a href="/users" class="hover:underline">Users</a></li>
            <li><a href="/bills" class="hover:underline">Billings</a></li>
            <li><a href="/roles" class="hover:underline">Roles</a></li>
            <li><a href="/ip_addresses" class="hover:underline">IP Addresses</a></li>
            <li><a href="/packages" class="hover:underline">Packages</a></li>
            <li><a href="/logout" class="hover:underline">Logout</a></li>
        </ul>
    </nav>
</header>

@inertia

<!-- Footer Section -->
<footer class="bg-gray-600 text-white p-4 fixed bottom-0 left-0 right-0">
    <div class="max-w-4xl mx-auto text-center">
        <p>&copy; {{ now()->year }} Billing Tracking. All rights reserved.</p>
    </div>
</footer>
<!-- Inertia Scripts -->
@vite('resources/js/app.js')
</body>
</html>
