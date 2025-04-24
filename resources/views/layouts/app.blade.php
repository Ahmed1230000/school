<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false }" x-cloak>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'School Dashboard')</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Google Fonts (Roboto for professional look) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @stack('styles')
    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .nav-link {
            transition: color 0.3s ease, transform 0.2s ease;
        }

        .nav-link:hover {
            transform: translateY(-1px);
        }

        .sidebar-link {
            transition: background-color 0.3s ease, color 0.3s ease;
            display: flex;
            align-items: center;
            padding: 0.75rem;
            border-radius: 0.375rem;
        }

        .sidebar-link:hover {
            background-color: #f1f5f9;
        }

        nav {
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: #fff;
        }

        main {
            flex: 1;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg p-4 sticky top-0 z-1000">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-600">MySchool</a>
            <ul class="flex space-x-6">
                <li><a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-blue-600 nav-link">Dashboard</a></li>
                <li><a href="{{ url('/students') }}" class="text-gray-700 hover:text-blue-600 nav-link">Students</a></li>
                <li><a href="{{ url('/teachers') }}" class="text-gray-700 hover:text-blue-600 nav-link">Teachers</a></li>
                <li>
                    <button @click="sidebarOpen = true" class="text-gray-700 hover:text-blue-600 nav-link focus:outline-none flex items-center">
                        <i class="fas fa-cog mr-1"></i> Settings
                    </button>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <div class="container mx-auto">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white text-center text-sm text-gray-500 py-6 mt-12 border-t">
        © {{ date('Y') }} MySchool. All rights reserved.
    </footer>

    <!-- Sidebar Settings Panel -->
    <div x-show="sidebarOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed inset-0 z-50 flex justify-end">

        <!-- Overlay -->
        <div class="fixed inset-0 bg-black bg-opacity-50" @click="sidebarOpen = false"></div>

        <!-- Sidebar -->
        <aside class="relative bg-white w-80 max-w-full h-full shadow-xl z-50 p-6 overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold text-gray-700">System Settings</h2>
                <button @click="sidebarOpen = false" class="text-gray-500 hover:text-red-600 focus:outline-none">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            <nav class="space-y-2">
                <a href="{{ route('roles.index') }}" class="sidebar-link text-blue-600 hover:text-blue-700">
                    <i class="fas fa-user-shield mr-2"></i> Manage Roles
                </a>
                <a href="{{ route('permissions.index') }}" class="sidebar-link text-yellow-600 hover:text-yellow-700">
                    <i class="fas fa-key mr-2"></i> Manage Permissions
                </a>
            </nav>
        </aside>
    </div>

    @stack('scripts')
</body>

</html>