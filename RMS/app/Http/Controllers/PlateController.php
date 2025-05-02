<?php

namespace App\Http\Controllers;

use App\Models\Plate;
use App\Models\PlateItem;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderItem;

class PlateController extends Controller
{
    public function show()
    {
        $plateId = Session::get('plate_id');
        $plate = $plateId ? Plate::with('items.dish')->find($plateId) : null;
        
        return view('plate.show', compact('plate'));
    }

    public function addItem(Request $request)
    {
        $request->validate([
            'dish_id' => 'required|exists:dishes,id',
            'quantity' => 'required|integer|min:1',
            'special_instructions' => 'nullable|string'
        ]);

        $plateId = Session::get('plate_id');
        if (!$plateId) {
            $plate = Plate::create([
                'status' => 'pending'
            ]);
            Session::put('plate_id', $plate->id);
            $plateId = $plate->id;
        }

        $dish = Dish::findOrFail($request->dish_id);
        
        PlateItem::create([
            'plate_id' => $plateId,
            'dish_id' => $dish->id,
            'quantity' => $request->quantity,
            'price' => $dish->price,
            'special_instructions' => $request->special_instructions
        ]);

        return redirect()->route('menu')->with('success', 'Item added to your plate!');
    }

    public function removeItem($itemId)
    {
        $plateId = Session::get('plate_id');
        $item = PlateItem::where('plate_id', $plateId)->findOrFail($itemId);
        $item->delete();

        return redirect()->route('plate.show')->with('success', 'Item removed from your plate!');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'pickup_time' => 'required|date|after:now'
        ]);

        $plateId = Session::get('plate_id');
        $plate = Plate::with('items.dish')->findOrFail($plateId);
        
        // Create a new Order record
        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'email' => $request->email,
            'status' => 'confirmed',
            'total_amount' => $plate->calculateTotal(),
            'pickup_time' => $request->pickup_time
        ]);
        
        // Create OrderItems from PlateItems
        foreach ($plate->items as $plateItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'dish_id' => $plateItem->dish_id,
                'quantity' => $plateItem->quantity,
                'price' => $plateItem->price
            ]);
        }

        // Send confirmation email
        Mail::to($order->email)->send(new OrderConfirmation($order));

        // Clear the session
        Session::forget('plate_id');

        return redirect()->route('plate.confirmation', $order->order_number);
    }

    public function confirmation($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();
        return view('plate.confirmation', compact('order'));
    }

    public function trackOrder(Request $request)
    {
        $request->validate([
            'order_number' => 'required|exists:orders,order_number'
        ]);

        $order = Order::where('order_number', $request->order_number)
                     ->with(['items.dish'])
                     ->firstOrFail();
                     
        return view('plate.track', compact('order'));
    }

    public function updateQuantity(Request $request, $itemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $plateItem = PlateItem::findOrFail($itemId);
        $plateItem->update([
            'quantity' => $request->quantity
        ]);

        return redirect()->route('menu')->with('success', 'Quantity updated!');
    }
}
