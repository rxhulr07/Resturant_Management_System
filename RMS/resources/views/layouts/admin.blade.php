<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yummy - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .bg-primary { background-color: #F59E0B; }
        .text-primary { color: #F59E0B; }
        .nav-link {
            @apply text-gray-500 hover:text-gray-700 px-4 py-2 text-sm font-medium rounded-md transition duration-150 ease-in-out;
        }
        .nav-link.active {
            @apply bg-primary bg-opacity-10 text-primary;
        }
    </style>
</head>
<body class="h-full flex flex-col min-h-screen bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold text-primary">
                        <i class="fas fa-utensils mr-2"></i>Yummy
                    </a>
                </div>
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                    </a>
                    <a href="{{ route('admin.dishes.index') }}" 
                       class="nav-link {{ request()->routeIs('admin.dishes.*') ? 'active' : '' }}">
                        <i class="fas fa-hamburger mr-2"></i>Menu
                    </a>
                    <a href="{{ route('admin.orders.index') }}" 
                       class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        <i class="fas fa-shopping-bag mr-2"></i>Orders
                    </a>
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline ml-2">
                        @csrf
                        <button type="submit" class="nav-link">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow mt-auto py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-500 text-sm">
                © {{ date('Y') }} Yummy Restaurant. All rights reserved.
            </p>
        </div>
    </footer>
</body>
</html> 