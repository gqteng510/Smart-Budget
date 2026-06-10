<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart – DineEasy</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: #F5E9DC;
            min-height: 100vh;
            color: #3D2010;
        }

        /* ── TOP NAV ── */
        .navbar {
            background: linear-gradient(135deg, #3D2010, #6B3E1E);
            padding: 0 40px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 20px rgba(61,32,16,0.35);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-brand {
            font-family: 'Playfair Display', serif;
            color: #F5E9DC;
            font-size: 1.4rem;
            letter-spacing: 0.02em;
        }

        .nav-brand span {
            color: #E8A96A;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .nav-user {
            color: rgba(245,233,220,0.75);
            font-size: 0.85rem;
        }

        .nav-link {
            color: #F5E9DC;
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            padding: 7px 14px;
            border-radius: 8px;
            transition: background 0.2s, color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .nav-link:hover {
            background: rgba(255,255,255,0.08);
            color: #E8A96A;
        }

        .btn-logout {
            background: rgba(255,255,255,0.12);
            color: #F5E9DC;
            border: 1px solid rgba(255,255,255,0.2);
            padding: 7px 18px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s;
        }
        .btn-logout:hover {
            background: rgba(255,255,255,0.22);
            border-color: rgba(255,255,255,0.4);
        }

        /* ── HERO BANNER ── */
        .hero {
            background: linear-gradient(135deg, #6B3E1E 0%, #8B5E3C 60%, #B87346 100%);
            padding: 40px;
            text-align: center;
            color: #fff;
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            margin-bottom: 8px;
        }

        .hero p {
            color: rgba(255,255,255,0.8);
            font-size: 0.95rem;
        }

        /* ── CONTAINER ── */
        .cart-container {
            max-width: 1200px;
            margin: 40px auto 60px;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }

        @media (max-width: 900px) {
            .cart-container {
                grid-template-columns: 1fr;
            }
        }

        /* ── ALERTS ── */
        .alert {
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-success {
            background: rgba(52,168,83,0.12);
            border: 1px solid rgba(52,168,83,0.25);
            color: #2e7d32;
        }

        /* ── CART ITEMS CARD ── */
        .cart-card {
            background: #fff;
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 4px 16px rgba(139,94,60,0.1);
            border: 1px solid rgba(139,94,60,0.06);
        }

        .cart-card h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            margin-bottom: 20px;
            border-bottom: 1px solid rgba(139,94,60,0.1);
            padding-bottom: 12px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 16px 0;
            border-bottom: 1px solid rgba(139,94,60,0.08);
        }

        .cart-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .item-img {
            width: 70px;
            height: 70px;
            border-radius: 12px;
            object-fit: cover;
            background: #EDD5BE;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }

        .item-info {
            flex: 1;
        }

        .item-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: #3D2010;
        }

        .item-category {
            font-size: 0.75rem;
            color: #8B6B52;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-top: 2px;
        }

        .item-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .quantity-form {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .quantity-input {
            width: 50px;
            padding: 6px;
            border-radius: 6px;
            border: 1.5px solid rgba(139,94,60,0.25);
            font-size: 0.88rem;
            text-align: center;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            color: #3D2010;
        }

        .btn-update {
            background: #8B5E3C;
            color: #fff;
            border: none;
            padding: 7px 10px;
            border-radius: 6px;
            font-size: 0.8rem;
            cursor: pointer;
            font-weight: 600;
        }
        .btn-update:hover {
            background: #6B3E1E;
        }

        .btn-remove {
            background: transparent;
            color: #c62828;
            border: 1px solid rgba(198,40,40,0.2);
            padding: 7px 12px;
            border-radius: 6px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-remove:hover {
            background: rgba(198,40,40,0.06);
            border-color: #c62828;
        }

        .item-price {
            font-weight: 700;
            font-size: 1.05rem;
            color: #8B5E3C;
            text-align: right;
            min-width: 90px;
        }

        /* ── SUMMARY CARD ── */
        .summary-card {
            background: #fff;
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 4px 16px rgba(139,94,60,0.1);
            border: 1px solid rgba(139,94,60,0.06);
            height: fit-content;
        }

        .summary-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            margin-bottom: 20px;
            border-bottom: 1px solid rgba(139,94,60,0.1);
            padding-bottom: 12px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            margin-bottom: 12px;
            color: #8B6B52;
        }

        .summary-row.total {
            font-size: 1.25rem;
            font-weight: 700;
            color: #3D2010;
            border-top: 1px dashed rgba(139,94,60,0.15);
            padding-top: 16px;
            margin-top: 16px;
            margin-bottom: 20px;
        }

        .total-price-val {
            color: #8B5E3C;
        }

        /* Budget Alerts */
        .budget-alert {
            padding: 12px;
            border-radius: 10px;
            font-size: 0.82rem;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
            line-height: 1.4;
        }
        .budget-alert.safe {
            background: rgba(52,168,83,0.1);
            border: 1px solid rgba(52,168,83,0.2);
            color: #2e7d32;
        }
        .budget-alert.danger {
            background: rgba(220,80,60,0.1);
            border: 1px solid rgba(220,80,60,0.2);
            color: #c62828;
        }

        .btn-checkout {
            width: 100%;
            background: linear-gradient(135deg, #8B5E3C, #B87346);
            color: #fff;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(139,94,60,0.3);
            transition: transform 0.15s, box-shadow 0.15s;
        }
        .btn-checkout:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(139,94,60,0.4);
        }
        .btn-checkout:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .btn-continue {
            display: block;
            text-align: center;
            margin-top: 15px;
            font-size: 0.85rem;
            color: #8B5E3C;
            text-decoration: none;
            font-weight: 600;
        }
        .btn-continue:hover {
            text-decoration: underline;
        }

        /* ── EMPTY STATE ── */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #8B5E3C;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 16px rgba(139,94,60,0.1);
            border: 1px solid rgba(139,94,60,0.06);
            grid-column: 1 / -1;
        }
        .empty-state .emoji { font-size: 4rem; display: block; margin-bottom: 16px; }
        .empty-state h2 { font-family: 'Playfair Display', serif; font-size: 1.6rem; margin-bottom: 8px; color: #3D2010; }
        .empty-state p { font-size: 0.9rem; opacity: 0.8; margin-bottom: 24px; }
        .btn-browse {
            display: inline-block;
            background: linear-gradient(135deg, #8B5E3C, #B87346);
            color: #fff;
            padding: 10px 24px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(139,94,60,0.3);
        }
        .btn-browse:hover {
            transform: translateY(-1px);
        }

        @media (max-width: 600px) {
            .navbar { padding: 0 20px; }
            .cart-item { flex-direction: column; align-items: flex-start; gap: 12px; }
            .item-actions { width: 100%; justify-content: space-between; }
            .item-price { text-align: left; min-width: auto; }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="nav-brand" style="display:flex; align-items:center; gap:10px;">
            <img src="{{ asset('images/logo.png') }}" style="height:38px; object-fit:contain;" alt="Logo">
            <span style="color:#F5E9DC;">Ezzati Catering</span>
        </div>
        <div class="nav-right">
            <a href="{{ route('dashboard') }}" class="nav-link" id="nav-dashboard">📊 Dashboard</a>
            <a href="{{ route('menu.index') }}" class="nav-link" id="nav-back-menu">🍜 Browse Menu</a>
            <a href="{{ route('orders.index') }}" class="nav-link" id="nav-my-orders">📋 My Orders</a>
            <span class="nav-user">Hello, {{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" id="btn-logout" class="btn-logout">Logout</button>
            </form>
        </div>
    </nav>

    <!-- HERO -->
    <div class="hero">
        <h1>Shopping Cart</h1>
        <p>Review your selected items and confirm your order</p>
    </div>

    <!-- MAIN CONTAINER -->
    <div class="cart-container">
        @if(session('success'))
            <div style="grid-column: 1 / -1;">
                <div class="alert alert-success">
                    <span>✅</span> {{ session('success') }}
                </div>
            </div>
        @endif

        @if(empty($items))
            <div class="empty-state">
                <span class="emoji">🛒</span>
                <h2>Your cart is empty</h2>
                <p>Add some delicious dishes from our catering menu first!</p>
                <a href="{{ route('menu.index') }}" class="btn-browse" id="btn-browse-menu">Browse Menu</a>
            </div>
        @else
            <!-- Cart Items -->
            <div class="cart-card">
                <h2>Cart Items</h2>
                
                @foreach($items as $item)
                    <div class="cart-item">
                        @if($item['menu']->image)
                            <img class="item-img" src="{{ asset('images/' . $item['menu']->image) }}" alt="{{ $item['menu']->name }}">
                        @else
                            <div class="item-img">🍜</div>
                        @endif

                        <div class="item-info">
                            <h3 class="item-name">{{ $item['menu']->name }}</h3>
                            <p class="item-category">{{ $item['menu']->category }}</p>
                        </div>

                        <div class="item-actions">
                            <form action="{{ route('cart.update', $item['menu']) }}" method="POST" class="quantity-form">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" class="quantity-input" value="{{ $item['quantity'] }}" min="1">
                                <button type="submit" class="btn-update" id="btn-update-{{ $item['menu']->id }}">Update</button>
                            </form>

                            <form action="{{ route('cart.remove', $item['menu']) }}" method="POST" style="margin:0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-remove" id="btn-remove-{{ $item['menu']->id }}">Remove</button>
                            </form>
                        </div>

                        <div class="item-price">
                            RM {{ number_format($item['subtotal'], 2) }}
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Checkout Summary -->
            <div class="summary-card">
                <h3>Order Summary</h3>
                
                <div class="summary-row">
                    <span>People (Pax)</span>
                    <span style="font-weight:600;color:#3D2010;">{{ $pax }}</span>
                </div>
                
                <div class="summary-row">
                    <span>Budget per Pax</span>
                    <span style="font-weight:600;color:#3D2010;">RM {{ number_format($pax > 0 ? $budget / $pax : 0, 2) }}</span>
                </div>

                <div class="summary-row">
                    <span>Total Budget Limit</span>
                    <span style="font-weight:600;color:#3D2010;">RM {{ number_format($budget, 2) }}</span>
                </div>

                <div class="summary-row total">
                    <span>Total Price</span>
                    <span class="total-price-val">RM {{ number_format($totalPrice, 2) }}</span>
                </div>

                <!-- Budget Calculator Feedback -->
                @php
                    $maxAllowed = $budget;
                    $isOverBudget = $totalPrice > $maxAllowed;
                @endphp

                @if($isOverBudget)
                    <div class="budget-alert danger">
                        <span>⚠️</span>
                        <strong>Over Budget!</strong> Total price exceeds your total budget of RM {{ number_format($maxAllowed, 2) }} by RM {{ number_format($totalPrice - $maxAllowed, 2) }}.
                    </div>
                @else
                    <div class="budget-alert safe">
                        <span>✅</span>
                        <strong>Within Budget!</strong> Total price is within your allocated budget of RM {{ number_format($maxAllowed, 2) }}.
                    </div>
                @endif

                @if($isOverBudget)
                    <span class="btn-checkout" style="opacity:0.45; cursor:not-allowed; pointer-events:none; display:block; text-align:center;">
                        Place Order
                    </span>
                @else
                    <a href="{{ route('order.checkout') }}" class="btn-checkout" id="btn-place-order" style="display:block; text-align:center; text-decoration:none;">
                        Place Order →
                    </a>
                @endif

                <a href="{{ route('menu.index') }}" class="btn-continue">← Continue Selecting Items</a>
            </div>
        @endif
    </div>

</body>
</html>
