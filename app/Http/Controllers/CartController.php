<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the cart contents.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $items = [];
        $totalPrice = 0;

        if (!empty($cart)) {
            $menus = Menu::whereIn('id', array_keys($cart))->get()->keyBy('id');
            
            foreach ($cart as $id => $quantity) {
                if (isset($menus[$id])) {
                    $menu = $menus[$id];
                    $subtotal = $menu->price * $quantity;
                    $totalPrice += $subtotal;
                    
                    $items[] = [
                        'menu' => $menu,
                        'quantity' => $quantity,
                        'subtotal' => $subtotal,
                    ];
                }
            }
        }

        $pax = session('pax', 1);
        $budget = session('budget', 0);

        return view('cart.index', compact('items', 'totalPrice', 'pax', 'budget'));
    }

    /**
     * Add a menu item to the cart.
     */
    public function add(Request $request, Menu $menu)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$menu->id])) {
            $cart[$menu->id]++;
        } else {
            $cart[$menu->id] = 1;
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', "{$menu->name} added to cart!");
    }

    /**
     * Update the quantity of a cart item.
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$menu->id])) {
            $cart[$menu->id] = (int) $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }

    /**
     * Remove a menu item from the cart.
     */
    public function remove(Menu $menu)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$menu->id])) {
            unset($cart[$menu->id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }
}
