<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout – Ezzati Catering</title>
    <meta name="description" content="Review your order and fill in delivery details to complete your catering booking.">
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
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .nav-brand span { color: #E8A96A; }
        .nav-right { display: flex; align-items: center; gap: 12px; }
        .nav-link {
            color: #F5E9DC;
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            padding: 7px 14px;
            border-radius: 8px;
            transition: background 0.2s;
        }
        .nav-link:hover { background: rgba(255,255,255,0.1); color: #E8A96A; }
        .nav-user { color: rgba(245,233,220,0.7); font-size: 0.82rem; }

        /* ── PAGE WRAPPER ── */
        .page-wrapper {
            max-width: 780px;
            margin: 0 auto;
            padding: 36px 24px 60px;
        }

        .page-heading {
            font-family: 'Playfair Display', serif;
            font-size: 1.7rem;
            color: #3D2010;
            margin-bottom: 6px;
        }
        .page-sub {
            color: #8B6B52;
            font-size: 0.9rem;
            margin-bottom: 28px;
        }



        /* ── CARDS ── */
        .card {
            background: #fff;
            border-radius: 16px;
            padding: 28px 32px;
            margin-bottom: 20px;
            box-shadow: 0 2px 12px rgba(139,94,60,0.08);
            border: 1px solid rgba(139,94,60,0.1);
        }

        /* Order Summary card – green tint matching screenshot */
        .card.summary {
            background: #F0FAF5;
            border-color: rgba(52,168,83,0.2);
        }
        .summary-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem;
            color: #1B5E35;
            margin-bottom: 18px;
            font-weight: 700;
        }
        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid rgba(52,168,83,0.12);
            font-size: 0.92rem;
        }
        .summary-item:last-child { border-bottom: none; }
        .summary-item .item-name { color: #2D7A4A; }
        .summary-item .item-price { color: #1B5E35; font-weight: 600; }
        .summary-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 0 0;
            margin-top: 6px;
            border-top: 2px solid rgba(52,168,83,0.25);
            font-size: 1rem;
            font-weight: 700;
            color: #1B5E35;
        }

        /* Delivery Details card */
        .section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #3D2010;
            margin-bottom: 22px;
            padding-bottom: 12px;
            border-bottom: 2px solid #F5E9DC;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 20px;
        }
        .form-group:last-child { margin-bottom: 0; }

        label {
            font-size: 0.83rem;
            font-weight: 600;
            color: #5C3D1E;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        label .req { color: #E53935; margin-left: 2px; }

        input[type="date"],
        input[type="time"],
        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1.5px solid #E0C8B0;
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 0.92rem;
            color: #3D2010;
            background: #FAFAFA;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }
        input[type="date"]:focus,
        input[type="time"]:focus,
        input[type="text"]:focus,
        textarea:focus {
            border-color: #8B5E3C;
            box-shadow: 0 0 0 3px rgba(139,94,60,0.1);
            background: #fff;
        }
        textarea {
            resize: vertical;
            min-height: 90px;
        }
        .error-text {
            font-size: 0.8rem;
            color: #c62828;
        }

        /* Ordering-as strip */
        .ordering-as {
            background: #EEF4FF;
            border: 1px solid rgba(66,133,244,0.2);
            border-radius: 10px;
            padding: 12px 16px;
            margin-top: 20px;
            font-size: 0.85rem;
            color: #3C4A6B;
            line-height: 1.5;
        }
        .ordering-as strong { color: #1A237E; }

        /* ── ACTION BUTTONS ── */
        .actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-top: 8px;
        }
        .btn-back {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 24px;
            border-radius: 12px;
            background: #fff;
            border: 2px solid #D4B896;
            color: #6B3E1E;
            font-size: 0.95rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s, border-color 0.2s;
        }
        .btn-back:hover { background: #F5E9DC; border-color: #8B5E3C; }

        .btn-confirm {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 24px;
            border-radius: 12px;
            background: linear-gradient(135deg, #5C3D1E, #8B5E3C);
            border: none;
            color: #fff;
            font-size: 0.95rem;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s;
            box-shadow: 0 4px 16px rgba(91,61,30,0.3);
        }
        .btn-confirm:hover { opacity: 0.9; transform: translateY(-1px); }
        .btn-confirm:active { transform: translateY(0); }

        /* ── VALIDATION ERRORS ── */
        .alert-error {
            background: #FFF3F3;
            border: 1px solid rgba(198,40,40,0.3);
            border-radius: 10px;
            padding: 14px 18px;
            margin-bottom: 20px;
            color: #c62828;
            font-size: 0.88rem;
        }

        @media (max-width: 600px) {
            .form-row { grid-template-columns: 1fr; }
            .actions { grid-template-columns: 1fr; }
            .page-wrapper { padding: 20px 16px 40px; }
            .card { padding: 20px 18px; }
            .navbar { padding: 0 20px; }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="nav-brand" style="display:flex; align-items:center; gap:12px;">
            <img src="{{ asset('images/logo.png') }}" style="height:42px; object-fit:contain;" alt="Logo">
            <span>Ezzati Catering</span>
        </div>
        <div class="nav-right">
            <span class="nav-user">👤 {{ auth()->user()->name }}</span>
            <a href="{{ route('cart.index') }}" class="nav-link">🛒 Cart</a>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" style="background:rgba(255,255,255,0.12); color:#F5E9DC; border:1px solid rgba(255,255,255,0.2); padding:7px 16px; border-radius:8px; font-size:0.85rem; font-family:inherit; cursor:pointer;">Sign Out</button>
            </form>
        </div>
    </nav>

    <div class="page-wrapper">

        <h1 class="page-heading">Order Now</h1>
        <p class="page-sub">Review your items and fill in delivery details to confirm your order.</p>



        {{-- Validation errors --}}
        @if($errors->any())
            <div class="alert-error">
                ❌ Please fix the following errors:
                <ul style="margin: 8px 0 0 16px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- ORDER SUMMARY CARD -->
        <div class="card summary">
            <div class="summary-title">Order Summary</div>

            @foreach($items as $item)
                <div class="summary-item">
                    <span class="item-name">{{ $item['menu']->name }}
                        @if($item['quantity'] > 1)
                            <span style="color:#4A9B6B; font-size:0.82rem;">(×{{ $item['quantity'] }})</span>
                        @endif
                    </span>
                    <span class="item-price">RM {{ number_format($item['subtotal'], 2) }}</span>
                </div>
            @endforeach

            <div class="summary-total">
                <span>Total ({{ $pax }} {{ $pax == 1 ? 'guest' : 'guests' }})</span>
                <span>RM {{ number_format($totalPrice, 2) }}</span>
            </div>
        </div>

        <!-- DELIVERY DETAILS CARD + FORM -->
        <div class="card">
            <div class="section-title">Delivery Details</div>

            <form action="{{ route('order.place') }}" method="POST" id="checkout-form">
                @csrf

                <div class="form-row">
                    <div class="form-group" style="margin-bottom:0;">
                        <label>📅 Delivery Date <span class="req">*</span></label>
                        <input type="date" name="delivery_date" id="delivery_date"
                               value="{{ old('delivery_date') }}"
                               min="{{ date('Y-m-d') }}" required>
                        @error('delivery_date')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-bottom:0;">
                        <label>🕐 Delivery Time <span class="req">*</span></label>
                        <input type="time" name="delivery_time" id="delivery_time"
                               value="{{ old('delivery_time') }}" required>
                        @error('delivery_time')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>📍 Delivery Address <span class="req">*</span></label>
                    <textarea name="delivery_address" id="delivery_address" rows="3"
                              placeholder="Enter your full delivery address…" required>{{ old('delivery_address', $user->address) }}</textarea>
                    @error('delivery_address')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>📋 Special Instructions <span style="color:#8B6B52; font-weight:400;">(Optional)</span></label>
                    <textarea name="special_instructions" id="special_instructions" rows="3"
                              placeholder="Dietary restrictions, setup preferences, etc.">{{ old('special_instructions') }}</textarea>
                    @error('special_instructions')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <!-- ORDERING AS STRIP -->
                <div class="ordering-as">
                    Ordering as <strong>{{ $user->name }}</strong>
                    ({{ $user->email }}{{ $user->phone ? ' · ' . $user->phone : '' }})
                </div>

                <!-- ACTION BUTTONS -->
                <div class="actions" style="margin-top: 28px;">
                    <a href="{{ route('cart.index') }}" class="btn-back" id="btn-back-to-cart">
                        ← Back
                    </a>
                    <button type="submit" class="btn-confirm" id="btn-confirm-order">
                        Confirm Order ✓
                    </button>
                </div>
            </form>
        </div>

    </div>

</body>
</html>
