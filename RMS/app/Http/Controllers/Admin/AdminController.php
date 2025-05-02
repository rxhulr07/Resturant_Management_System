<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Plate;
use App\Models\Dish;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('admin/orders');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function dashboard()
    {
        $totalOrders = Plate::where('status', '!=', 'pending')->count();
        $totalDishes = Dish::count();
        $recentOrders = Plate::where('status', '!=', 'pending')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('totalOrders', 'totalDishes', 'recentOrders'));
    }

    public function orders()
    {
        $orders = Plate::where('status', '!=', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function showOrder(Plate $plate)
    {
        return view('admin.orders.show', compact('plate'));
    }

    public function updateStatus(Request $request, Plate $plate)
    {
        $request->validate([
            'status' => ['required', 'in:confirmed,ready,collected'],
        ]);

        $plate->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Order status updated successfully');
    }
} 