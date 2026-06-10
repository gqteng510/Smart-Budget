<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the customer's orders.
     */
    public function index()
    {
        $orders = auth()->user()->orders()->with('items')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Store a newly created order in database.
     */
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('menu.index')->with('error', 'Your cart is empty.');
        }

        $menus = Menu::whereIn('id', array_keys($cart))->get()->keyBy('id');
        $totalPrice = 0;

        foreach ($cart as $id => $quantity) {
            if (isset($menus[$id])) {
                $totalPrice += $menus[$id]->price * $quantity;
            }
        }

        // Create the order
        $order = Order::create([
            'user_id' => auth()->id(),
            'pax' => session('pax', 1),
            'budget' => session('budget', 0),
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        // Create the order items
        foreach ($cart as $id => $quantity) {
            if (isset($menus[$id])) {
                $menu = $menus[$id];
                $order->items()->create([
                    'menu_id' => $menu->id,
                    'name' => $menu->name,
                    'price' => $menu->price,
                    'quantity' => $quantity,
                ]);
            }
        }

        // Clear the cart
        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Order placed successfully! Keep track of your status below.');
    }

    /**
     * Display the admin's order management dashboard.
     */
    public function adminIndex()
    {
        $orders = Order::with(['user', 'items'])->latest()->get();
        return view('menu.orders', compact('orders'));
    }

    /**
     * Update the status of an order.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|in:pending,accepted,completed,cancelled',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }
}
