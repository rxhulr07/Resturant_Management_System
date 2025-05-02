@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <div class="mb-6">
                <i class="fas fa-check-circle text-6xl text-green-500"></i>
            </div>
            
            <h1 class="text-3xl font-bold mb-4">Order Confirmed!</h1>
            <p class="text-gray-600 mb-8">
                Thank you for your order. We've sent a confirmation email to {{ $order->email }}.
            </p>

            <div class="bg-gray-50 rounded-lg p-6 mb-8">
                <h2 class="text-xl font-semibold mb-4">Order Details</h2>
                <div class="grid grid-cols-2 gap-4 text-left">
                    <div>
                        <p class="text-gray-600">Order Number:</p>
                        <p class="font-medium">{{ $order->order_number }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Pickup Time:</p>
                        <p class="font-medium">{{ $order->pickup_time->format('F j, Y g:i A') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Status:</p>
                        <p class="font-medium capitalize">{{ $order->status }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Total Amount:</p>
                        <p class="font-medium">${{ number_format($order->total_amount, 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <p class="text-gray-600">
                    Please save your order number for pickup:
                    <span class="font-bold text-xl block mt-2">{{ $order->order_number }}</span>
                </p>
                
                <div class="border-t pt-6">
                    <a href="{{ route('plate.track', ['order_number' => $order->order_number]) }}" 
                       class="inline-block bg-primary text-black px-6 py-3 rounded-md hover:bg-yellow-500 transition duration-150">
                        Track Order
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 