<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Dish - Restaurant Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <h1 class="text-xl font-bold">Restaurant Admin</h1>
                    </div>
                    <div class="hidden md:ml-6 md:flex md:space-x-8">
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-gray-300 text-sm font-medium">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.dishes.index') }}" class="text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 border-indigo-500 text-sm font-medium">
                            Menu
                        </a>
                        <a href="{{ route('admin.orders.index') }}" class="text-gray-500 hover:text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-gray-300 text-sm font-medium">
                            Orders
                        </a>
                    </div>
                </div>
                <div class="flex items-center">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-gray-900">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="mb-4">
                <h2 class="text-2xl font-bold">Edit Dish</h2>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
                <form action="{{ route('admin.dishes.update', $dish) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    @if ($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">There were errors with your submission:</h3>
                                    <ul class="mt-2 text-sm text-red-700">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $dish->name) }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="3" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('description', $dish->description) }}</textarea>
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" name="price" id="price" value="{{ old('price', $dish->price) }}" required step="0.01" min="0" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                        <select name="category" id="category" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select a category</option>
                            <option value="Appetizers" {{ old('category', $dish->category) == 'Appetizers' ? 'selected' : '' }}>Appetizers</option>
                            <option value="Main Course" {{ old('category', $dish->category) == 'Main Course' ? 'selected' : '' }}>Main Course</option>
                            <option value="Desserts" {{ old('category', $dish->category) == 'Desserts' ? 'selected' : '' }}>Desserts</option>
                            <option value="Beverages" {{ old('category', $dish->category) == 'Beverages' ? 'selected' : '' }}>Beverages</option>
                        </select>
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                        @if($dish->image)
                            <div class="mt-2 mb-4">
                                <img src="{{ Storage::url($dish->image) }}" alt="{{ $dish->name }}" class="h-32 w-32 object-cover rounded">
                            </div>
                        @endif
                        <input type="file" name="image" id="image" accept="image/*" class="mt-1 block w-full">
                        <p class="mt-1 text-sm text-gray-500">Leave empty to keep the current image</p>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="checkbox" name="is_available" id="is_available" value="1" {{ old('is_available', $dish->is_available) ? 'checked' : '' }} class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="is_available" class="font-medium text-gray-700">Available</label>
                            <p class="text-gray-500">Check if this dish is currently available</p>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('admin.dishes.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cancel
                        </a>
                        <button type="submit" class="bg-indigo-600 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update Dish
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 