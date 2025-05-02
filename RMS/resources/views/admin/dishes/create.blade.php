@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Add New Dish</h1>
        <a href="{{ route('admin.dishes.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
            <i class="fas fa-arrow-left mr-2"></i>Back to Menu
        </a>
    </div>

    <form action="{{ route('admin.dishes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-400"></i>
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

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required 
                    class="mt-1 focus:ring-primary focus:border-primary block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>

            <div>
                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category" id="category" required 
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                    <option value="">Select a category</option>
                    <option value="Appetizers" {{ old('category') == 'Appetizers' ? 'selected' : '' }}>Appetizers</option>
                    <option value="Main Course" {{ old('category') == 'Main Course' ? 'selected' : '' }}>Main Course</option>
                    <option value="Desserts" {{ old('category') == 'Desserts' ? 'selected' : '' }}>Desserts</option>
                    <option value="Beverages" {{ old('category') == 'Beverages' ? 'selected' : '' }}>Beverages</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="3" required 
                    class="mt-1 focus:ring-primary focus:border-primary block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('description') }}</textarea>
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">$</span>
                    </div>
                    <input type="number" name="price" id="price" value="{{ old('price') }}" required step="0.01" min="0" 
                        class="focus:ring-primary focus:border-primary block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                <div class="mt-1 flex items-center">
                    <input type="file" name="image" id="image" accept="image/*" 
                        class="focus:ring-primary focus:border-primary block w-full sm:text-sm border-gray-300">
                </div>
            </div>

            <div class="md:col-span-2">
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input type="checkbox" name="is_available" id="is_available" value="1" {{ old('is_available') ? 'checked' : '' }} 
                            class="focus:ring-primary h-4 w-4 text-primary border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="is_available" class="font-medium text-gray-700">Available</label>
                        <p class="text-gray-500">Check if this dish is currently available</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-3 pt-4 border-t">
            <a href="{{ route('admin.dishes.index') }}" 
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                <i class="fas fa-times mr-2"></i>Cancel
            </a>
            <button type="submit" 
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary border border-transparent rounded-md hover:bg-primary-dark">
                <i class="fas fa-plus mr-2"></i>Create Dish
            </button>
        </div>
    </form>
</div>
@endsection 