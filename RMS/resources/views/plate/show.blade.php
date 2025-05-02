@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Your Plate</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(!$plate || $plate->items->isEmpty())
        <div class="text-center py-8">
            <p class="text-gray-600 text-xl mb-4">Your plate is empty</p>
            <a href="{{ route('menu') }}" class="bg-primary text-white px-6 py-3 rounded-md hover:bg-yellow-500">
                View Menu
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Items List -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Order Items</h2>
                    @foreach($plate->items as $item)
                        <div class="border-b py-4 last:border-b-0">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-medium">{{ $item->dish->name }}</h3>
                                    <p class="text-gray-600">Quantity: {{ $item->quantity }}</p>
                                    @if($item->special_instructions)
                                        <p class="text-sm text-gray-500 mt-1">
                                            Note: {{ $item->special_instructions }}
                                        </p>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <p class="font-medium">${{ number_format($item->subtotal, 2) }}</p>
                                    <form action="{{ route('plate.remove-item', $item->id) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 text-sm hover:text-red-700">
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Checkout Form -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                    <div class="border-b pb-4 mb-4">
                        <div class="flex justify-between mb-2">
                            <span>Subtotal</span>
                            <span>${{ number_format($plate->calculateTotal(), 2) }}</span>
                        </div>
                        <div class="flex justify-between font-semibold">
                            <span>Total</span>
                            <span>${{ number_format($plate->calculateTotal(), 2) }}</span>
                        </div>
                    </div>

                    <form action="{{ route('plate.checkout') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 mb-2">Email Address</label>
                            <input type="email" name="email" id="email" required
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
                                placeholder="your@email.com">
                        </div>

                        <div class="mb-6">
                            <label for="pickup_time" class="block text-gray-700 mb-2">Pickup Time</label>
                            <input type="datetime-local" name="pickup_time" id="pickup_time" required
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
                                min="{{ now()->addMinutes(30)->format('Y-m-d\TH:i') }}">
                        </div>

                        <button type="submit" class="w-full bg-primary text-black font-medium py-3 rounded-md hover:bg-yellow-500 transition duration-150">
                            Proceed to Payment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection 