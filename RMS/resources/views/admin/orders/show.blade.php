@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Order Details</h1>
        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
            <i class="fas fa-arrow-left mr-2"></i>Back to Orders
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white overflow-hidden sm:rounded-lg">
        <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Order Number</dt>
                    <dd class="mt-1 text-sm text-gray-900">#{{ $order->order_number }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Customer Email</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $order->email }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="mt-1">
                        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="inline-flex items-center">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()" 
                                class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md">
                                <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="ready" {{ $order->status === 'ready' ? 'selected' : '' }}>Ready</option>
                                <option value="collected" {{ $order->status === 'collected' ? 'selected' : '' }}>Collected</option>
                            </select>
                        </form>
                    </dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Total Amount</dt>
                    <dd class="mt-1 text-sm text-gray-900">${{ number_format($order->total_amount, 2) }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Pickup Time</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $order->pickup_time->format('M d, Y h:i A') }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Order Date</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $order->created_at->format('M d, Y h:i A') }}</dd>
                </div>
            </dl>
        </div>
    </div>

    <div class="mt-6">
        <h3 class="text-lg font-medium text-gray-900">Actions</h3>
        <div class="mt-3 flex space-x-3">
            <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="inline" 
                onsubmit="return confirm('Are you sure you want to delete this order?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                    <i class="fas fa-trash-alt mr-2"></i>Delete Order
                </button>
            </form>
        </div>
    </div>
</div>
@endsection 