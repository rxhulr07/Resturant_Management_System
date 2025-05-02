<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yummy - Delicious Food</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .bg-primary { background-color: #F59E0B; }
        .text-primary { color: #F59E0B; }
        .hover\:bg-primary:hover { background-color: #D97706; }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="/" class="text-2xl font-bold text-primary">Yummy</a>
                    </div>
                    <div class="hidden md:ml-6 md:flex md:space-x-8">
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('menu') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Menu</a>
                            <a href="{{ route('plate.show') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium relative">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                @if(Session::has('plate_id'))
                                    <span class="absolute -top-1 -right-1 bg-primary text-white rounded-full h-5 w-5 flex items-center justify-center text-xs">
                                        {{ App\Models\Plate::find(Session::get('plate_id'))?->items->count() ?? 0 }}
                                    </span>
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    @auth
                        <a href="{{ route('plate.show') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="ml-1">Cart</span>
                        </a>
                        <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-gray-900">Logout</button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 mt-12">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    Yummy
                </h2>
                <p class="mt-4 text-base text-gray-300">
                    &copy; 2024 Yummy Restaurant. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</body>
</html> 