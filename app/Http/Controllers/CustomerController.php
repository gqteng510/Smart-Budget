<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of registered customers.
     */
    public function index()
    {
        $customers = User::where('usertype', 'user')
                        ->withCount('orders')
                        ->latest()
                        ->get();
        return view('customers.index', compact('customers'));
    }

    /**
     * Display all orders for a specific customer (admin view).
     */
    public function customerOrders(User $user)
    {
        $orders = $user->orders()->with('items')->latest()->get();
        return view('customers.orders', compact('user', 'orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        Customer::create($validated);
        return redirect()->route('dashboard')->with('success', 'Your information has been saved successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
}
