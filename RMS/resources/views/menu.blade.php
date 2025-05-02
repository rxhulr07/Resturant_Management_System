@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Our Menu</h1>

    <!-- Category Filter -->
    <div class="mb-8">
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('menu') }}" 
               class="px-4 py-2 rounded-full {{ !request('category') ? 'bg-primary text-white' : 'bg-gray-200' }}">
                All
            </a>
            @foreach($categories as $category)
                <a href="{{ route('menu', ['category' => $category->slug]) }}" 
                   class="px-4 py-2 rounded-full {{ request('category') == $category->slug ? 'bg-primary text-white' : 'bg-gray-200' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Menu Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($dishes as $dish)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                @if($dish->image)
                    <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-400">No image available</span>
                    </div>
                @endif
                
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-semibold">{{ $dish->name }}</h3>
                        <span class="text-primary font-bold">${{ number_format($dish->price, 2) }}</span>
                    </div>
                    
                    <p class="text-gray-600 mb-4">{{ $dish->description }}</p>
                    
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm text-gray-500">{{ $dish->category->name }}</span>
                        @if($dish->is_available)
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">Available</span>
                        @else
                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-sm">Unavailable</span>
                        @endif
                    </div>

                    @if($dish->is_available)
                        @php
                            $plateItem = $plate ? $plate->items->where('dish_id', $dish->id)->first() : null;
                        @endphp
                        
                        @if($plateItem)
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-green-600 font-medium">Added to Plate</span>
                                    <form action="{{ route('plate.remove-item', $plateItem->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                <form action="{{ route('plate.update-quantity', $plateItem->id) }}" method="POST" class="flex items-center space-x-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $plateItem->quantity }}" min="1" 
                                           class="w-20 rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                                    <button type="submit" class="text-primary hover:text-primary-dark">Update</button>
                                </form>
                            </div>
                        @else
                            <form action="{{ route('plate.add-item') }}" method="POST" class="space-y-4">
                                @csrf
                                <input type="hidden" name="dish_id" value="{{ $dish->id }}">
                                
                                <div>
                                    <label for="quantity-{{ $dish->id }}" class="block text-sm font-medium text-gray-700">Quantity</label>
                                    <input type="number" name="quantity" id="quantity-{{ $dish->id }}" value="1" min="1" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                                </div>

                                <div>
                                    <label for="special_instructions-{{ $dish->id }}" class="block text-sm font-medium text-gray-700">Special Instructions</label>
                                    <textarea name="special_instructions" id="special_instructions-{{ $dish->id }}" rows="2"
                                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                                              placeholder="Any special requests?"></textarea>
                                </div>

                                <button type="submit" class="w-full bg-primary text-black px-4 py-2 rounded-md hover:bg-yellow-500 transition duration-150">
                                    Add to Plate
                                </button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    @if($dishes->isEmpty())
        <div class="text-center py-8">
            <p class="text-gray-500">No dishes found in this category.</p>
        </div>
    @endif
</div>
@endsection 