<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Dish;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDishes = Dish::count();
        $totalCategories = Category::count();
        $totalOrders = Order::count();
        $recentOrders = Order::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalDishes',
            'totalCategories',
            'totalOrders',
            'recentOrders'
        ));
    }
} 