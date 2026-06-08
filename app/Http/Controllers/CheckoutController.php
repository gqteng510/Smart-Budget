<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // PAGE 1: Papar Menu Utama
    public function menuIndex()
    {
        $budget = 1000.00;
        return view('checkout.menu', compact('budget'));
    }

    // PROSES PERTENGAHAN: Tangkap data yang di-tick dan simpan ke Session
    public function saveMenu(Request $request)
    {
        // Ambil array package yang dipilih
        $selectedPackages = $request->input('selected_packages', []);

        $cart = [];
        foreach ($selectedPackages as $packageJson) {
            // Tukar string JSON balik menjadi Array PHP
            $packageData = json_decode($packageJson, true);
            if ($packageData) {
                $cart[] = [
                    'name' => $packageData['name'],
                    'price' => $packageData['price']
                ];
            }
        }

        // Simpan ke dalam session dengan nama 'cart'
        session(['cart' => $cart]);

        // Alirkan pengguna ke Page 2 (Checkout form)
        return redirect()->route('checkout.index');
    }

    // PAGE 2: Papar Checkout Form & Ambil data dari Session secara Dinamik
    public function index()
    {
        $budget = 1000.00;
        $guests = session('guests', 50); // Kekal 50 tetamu

        // Membaca data daripada session 'cart'. Jika kosong, set default empty array
        $cartItems = session('cart', []);

        $totalAmount = 0;
        $orderSummary = [];

        // Kira jumlah kos sebenar berdasarkan item yang di-tick dari Page 1
        foreach ($cartItems as $item) {
            $itemTotal = $item['price'] * $guests;
            $totalAmount += $itemTotal;

            $orderSummary[] = [
                'name' => $item['name'],
                'price' => $item['price'],
                'item_total' => $itemTotal
            ];
        }

        return view('checkout.index', compact('guests', 'orderSummary', 'totalAmount', 'budget'));
    }

    // PROSES SIMPAN TO DB: Kekal sama
    public function placeOrder(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string',
            'delivery_address' => 'required|string',
            'total_amount' => 'required|numeric',
            'number_of_guests' => 'required|integer'
        ]);

        $orderId = DB::table('orders')->insertGetId([
            'customer_name' => 'Ezzati Customer',
            'phone_number' => $request->phone_number,
            'delivery_address' => $request->delivery_address,
            'number_of_guests' => $request->number_of_guests,
            'total_amount' => $request->total_amount,
            'status' => 'Pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Bersihkan session cart selepas order berjaya dibuat
        session()->forget('cart');

        return redirect()->route('checkout.success', ['id' => $orderId]);
    }

    // PAGE 3: Success Page
    public function success($id)
    {
        $order = DB::table('orders')->where('id', $id)->first();
        return view('checkout.success', compact('order'));
    }
}
