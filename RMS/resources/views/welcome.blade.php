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
        <nav class="bg-white shadow-lg fixed top-0 left-0 right-0 z-50">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="/" class="text-2xl font-bold text-primary">Yummy</a>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('menu') }}" class="text-gray-600 hover:text-gray-900">Menu</a>
                        <a href="#contact" class="text-gray-600 hover:text-gray-900">Contact</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative h-[50vh] bg-gray-900 pt-16">
            <div class="absolute inset-0 top-16">
                <img src="https://images.unsplash.com/photo-1552566626-52f8b828add9?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" 
                     alt="Restaurant Interior" 
                     class="w-full h-full object-cover opacity-40">
                <div class="absolute inset-0 bg-gradient-to-r from-black to-transparent"></div>
            </div>
            <div class="relative max-w-7xl mx-auto px-4 h-full flex items-center">
                <div class="w-full md:w-1/2 p-8 border-l-4 border-primary bg-black bg-opacity-30 backdrop-blur-sm rounded-r-lg">
                    <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl mb-6">
                        Discover the Art of Fine Dining
                    </h1>
                    <p class="text-xl text-gray-200 max-w-2xl mb-8">
                        Indulge in a culinary journey where every dish tells a story. Experience flavors that will transport you to new heights of gastronomic delight.
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('menu') }}" 
                           class="inline-flex items-center justify-center px-8 py-3 border-2 border-transparent text-base font-medium rounded-md text-black bg-primary hover:bg-yellow-500 transition duration-150 ease-in-out">
                            Explore Menu
                            <i class="fas fa-utensils ml-2"></i>
                        </a>
                        <a href="#contact" 
                           class="inline-flex items-center justify-center px-8 py-3 border-2 border-white text-base font-medium rounded-md text-white hover:bg-white hover:text-black transition duration-150 ease-in-out">
                            Book a Table
                            <i class="fas fa-calendar-alt ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-base text-primary font-semibold tracking-wide uppercase">Why Choose Us</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        The Yummy Experience
                    </p>
                </div>

                <div class="mt-12">
                    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                        <div class="text-center">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-primary text-white mx-auto">
                                <i class="fas fa-utensils text-xl"></i>
                            </div>
                            <h3 class="mt-6 text-lg font-medium text-gray-900">Fresh Ingredients</h3>
                            <p class="mt-2 text-base text-gray-500">
                                We use only the freshest ingredients to ensure the best taste in every dish.
                            </p>
                        </div>

                        <div class="text-center">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-primary text-white mx-auto">
                                <i class="fas fa-clock text-xl"></i>
                            </div>
                            <h3 class="mt-6 text-lg font-medium text-gray-900">Quick Service</h3>
                            <p class="mt-2 text-base text-gray-500">
                                Fast and efficient service to ensure you get your food when you want it.
                            </p>
                        </div>

                        <div class="text-center">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-primary text-white mx-auto">
                                <i class="fas fa-star text-xl"></i>
                            </div>
                            <h3 class="mt-6 text-lg font-medium text-gray-900">Best Quality</h3>
                            <p class="mt-2 text-base text-gray-500">
                                Our chefs prepare each dish with care to ensure the highest quality.
                            </p>
                        </div>

                        <div class="text-center">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-primary text-white mx-auto">
                                <i class="fas fa-mobile-alt text-xl"></i>
                            </div>
                            <h3 class="mt-6 text-lg font-medium text-gray-900">Easy Ordering</h3>
                            <p class="mt-2 text-base text-gray-500">
                                Simple and fast ordering process through our website.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div id="contact" class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-base text-primary font-semibold tracking-wide uppercase">Contact Us</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        Get in Touch
                    </p>
                </div>
                <div class="mt-12 max-w-lg mx-auto">
                    <div class="grid grid-cols-1 gap-6">
                        <div class="flex items-center justify-center space-x-4">
                            <i class="fas fa-phone text-primary text-xl"></i>
                            <span class="text-gray-600">+1 234 567 890</span>
                        </div>
                        <div class="flex items-center justify-center space-x-4">
                            <i class="fas fa-envelope text-primary text-xl"></i>
                            <span class="text-gray-600">info@yummy.com</span>
                        </div>
                        <div class="flex items-center justify-center space-x-4">
                            <i class="fas fa-map-marker-alt text-primary text-xl"></i>
                            <span class="text-gray-600">123 Restaurant Street, Food City</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-800">
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
