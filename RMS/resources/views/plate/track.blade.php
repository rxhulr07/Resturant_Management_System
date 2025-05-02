@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold mb-8">Track Your Order</h1>

        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="grid md:grid-cols-2 gap-6 mb-8">
                <div>
                    <h2 class="text-xl font-semibold mb-4">Order Information</h2>
                    <div class="space-y-3">
                        <div>
                            <p class="text-gray-600">Order Number:</p>
                            <p class="font-medium">{{ $order->order_number }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Pickup Time:</p>
                            <p class="font-medium">{{ $order->pickup_time->format('F j, Y g:i A') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Total Amount:</p>
                            <p class="font-medium">${{ number_format($order->total_amount, 2) }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-xl font-semibold mb-4">Order Status</h2>
                    <div class="relative">
                        <div class="absolute left-4 inset-y-0 w-0.5 bg-gray-200"></div>
                        <div class="space-y-6 relative">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-8 h-8 bg-{{ $order->status == 'confirmed' ? 'green' : 'gray' }}-500 rounded-full flex items-center justify-center">
                                    <i class="fas fa-check text-white text-sm"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="font-medium">Order Confirmed</p>
                                    <p class="text-sm text-gray-500">Your order has been confirmed</p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-8 h-8 bg-{{ $order->status == 'ready' ? 'green' : 'gray' }}-500 rounded-full flex items-center justify-center">
                                    <i class="fas fa-utensils text-white text-sm"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="font-medium">Order Ready</p>
                                    <p class="text-sm text-gray-500">Your order is ready for pickup</p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-8 h-8 bg-{{ $order->status == 'collected' ? 'green' : 'gray' }}-500 rounded-full flex items-center justify-center">
                                    <i class="fas fa-check-double text-white text-sm"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="font-medium">Order Collected</p>
                                    <p class="text-sm text-gray-500">Order has been collected</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t pt-6">
                <h2 class="text-xl font-semibold mb-4">Order Items</h2>
                <div class="space-y-4">
                    @foreach($order->items as $item)
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-medium">{{ $item->dish->name }}</h3>
                                <p class="text-gray-600">Quantity: {{ $item->quantity }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-medium">${{ number_format($item->quantity * $item->price, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="text-center">
            <p class="text-gray-600 mb-4">
                Please show your order number or confirmation email when collecting your order.
            </p>
            <a href="{{ route('menu') }}" class="inline-block bg-primary text-black px-6 py-3 rounded-md hover:bg-yellow-500 transition duration-150">
                Back to Menu
            </a>
        </div>
    </div>
</div>
@endsection 