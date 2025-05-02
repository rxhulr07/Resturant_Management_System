@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Admin Dashboard</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Menu Items Card -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-primary bg-opacity-10">
                    <i class="fas fa-utensils text-primary text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-600 text-sm">Total Menu Items</h2>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalDishes ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Categories Card -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-primary bg-opacity-10">
                    <i class="fas fa-list text-primary text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-600 text-sm">Categories</h2>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalCategories ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-primary bg-opacity-10">
                    <i class="fas fa-shopping-bag text-primary text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-600 text-sm">Total Orders</h2>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalOrders ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="mt-8">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Recent Orders</h2>
        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            @if($recentOrders && $recentOrders->count() > 0)
                <ul class="divide-y divide-gray-200">
                    @foreach($recentOrders as $order)
                    <li>
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <p class="text-sm font-medium text-primary">Order #{{ $order->order_number }}</p>
                                    <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $order->status === 'confirmed' ? 'bg-green-100 text-green-800' : 
                                           ($order->status === 'ready' ? 'bg-yellow-100 text-yellow-800' : 
                                           'bg-gray-100 text-gray-800') }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ optional($order->created_at)->format('M d, Y H:i') }}
                                </div>
                            </div>
                            <div class="mt-2">
                                <p class="text-sm text-gray-600">
                                    Pickup Time: {{ optional($order->pickup_time)->format('M d, Y H:i') }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    Total: ${{ number_format($order->total_amount ?? 0, 2) }}
                                </p>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            @else
                <div class="px-4 py-5 text-center text-gray-500">
                    No recent orders found
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 