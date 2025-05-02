<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Plate;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Dish::query();
        
        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        
        $dishes = $query->with('category')->get();
        $categories = Category::all();
        
        // Get the current plate if it exists
        $plateId = Session::get('plate_id');
        $plate = $plateId ? Plate::with('items.dish')->find($plateId) : null;
        
        return view('menu', compact('dishes', 'categories', 'plate'));
    }
} 