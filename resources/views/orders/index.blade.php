<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders – DineEasy</title>
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
        .dashboard-container {
            max-width: 1000px;
            margin: 40px auto 60px;
            padding: 0 20px;
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

        /* ── ORDER CARD ── */
        .order-card {
            background: #fff;
            border-radius: 18px;
            padding: 24px;
            margin-bottom: 20px;
            box-shadow: 0 4px 16px rgba(139,94,60,0.08);
            border: 1px solid rgba(139,94,60,0.06);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(139,94,60,0.1);
            padding-bottom: 14px;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .order-ref {
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem;
            font-weight: 700;
        }
        .order-date {
            font-size: 0.8rem;
            color: #8B6B52;
            margin-left: 10px;
            font-weight: 400;
        }

        /* Color-coded badges */
        .badge {
            font-size: 0.78rem;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .badge.pending {
            background: rgba(242,153,74,0.12);
            color: #E28743;
            border: 1.5px solid rgba(242,153,74,0.25);
        }
        .badge.accepted {
            background: rgba(24, 144, 255, 0.12);
            color: #1890ff;
            border: 1.5px solid rgba(24, 144, 255, 0.25);
        }
        .badge.completed {
            background: rgba(52,168,83,0.12);
            color: #2e7d32;
            border: 1.5px solid rgba(52,168,83,0.25);
        }
        .badge.cancelled {
            background: rgba(220,80,60,0.12);
            color: #c62828;
            border: 1.5px solid rgba(220,80,60,0.25);
        }

        .order-details-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            background: #FDF9F5;
            padding: 14px 20px;
            border-radius: 10px;
            border: 1px solid rgba(139,94,60,0.05);
            margin-bottom: 16px;
        }

        @media (max-width: 600px) {
            .order-details-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }
        }

        .detail-label {
            font-size: 0.75rem;
            color: #8B6B52;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 2px;
        }
        .detail-value {
            font-size: 1rem;
            font-weight: 600;
            color: #3D2010;
        }

        .items-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            padding: 8px 0;
            font-size: 0.85rem;
            font-weight: 600;
            color: #8B5E3C;
            user-select: none;
        }
        .items-toggle:hover {
            color: #6B3E1E;
        }

        .items-list-wrap {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .items-list-wrap.open {
            max-height: 800px;
        }

        .order-item-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 12px;
            border-bottom: 1px dashed rgba(139,94,60,0.1);
            font-size: 0.88rem;
        }
        .order-item-row:last-child {
            border-bottom: none;
        }

        .item-qty-name {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .item-qty {
            font-weight: 700;
            color: #8B5E3C;
            background: rgba(139,94,60,0.08);
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.78rem;
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
            <span class="nav-user">Hello, {{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" id="btn-logout" class="btn-logout">Logout</button>
            </form>
        </div>
    </nav>

    <!-- HERO -->
    <div class="hero">
        <h1>My Orders</h1>
        <p>Monitor your catering booking status and details below</p>
    </div>

    <!-- MAIN CONTAINER -->
    <div class="dashboard-container">
        @if(session('success'))
            <div class="alert alert-success">
                <span>✅</span> {{ session('success') }}
            </div>
        @endif

        @if($orders->isEmpty())
            <div class="empty-state">
                <span class="emoji">📋</span>
                <h2>No orders placed yet</h2>
                <p>Add items to your cart and complete checkout to submit your first order!</p>
                <a href="{{ route('menu.index') }}" class="btn-browse" id="btn-browse-menu">Browse Menu</a>
            </div>
        @else
            @foreach($orders as $order)
                <div class="order-card" id="order-card-{{ $order->id }}">
                    <div class="order-header">
                        <div>
                            <span class="order-ref">Order #{{ sprintf('%05d', $order->id) }}</span>
                            <span class="order-date">{{ $order->created_at->format('M d, Y h:i A') }}</span>
                        </div>
                        <span class="badge {{ $order->status }}" id="order-status-{{ $order->id }}">
                            {{ $order->status }}
                        </span>
                    </div>

                    <!-- Details Grid -->
                    <div class="order-details-grid">
                        <div>
                            <div class="detail-label">Pax Size</div>
                            <div class="detail-value">{{ $order->pax }} {{ $order->pax == 1 ? 'pax' : 'pax' }}</div>
                        </div>
                        <div>
                            <div class="detail-label">Catering Budget</div>
                            <div class="detail-value">RM {{ number_format($order->budget, 2) }} / pax</div>
                        </div>
                        <div>
                            <div class="detail-label">Total Amount</div>
                            <div class="detail-value" style="color:#8B5E3C;">RM {{ number_format($order->total_price, 2) }}</div>
                        </div>
                    </div>

                    <!-- Accordion Items Listing -->
                    <div>
                        <div class="items-toggle" onclick="toggleItems({{ $order->id }}, this)" id="toggle-items-{{ $order->id }}">
                            <span>Items List ({{ $order->items->count() }})</span>
                            <span class="chevron">▼</span>
                        </div>
                        
                        <div class="items-list-wrap" id="items-list-{{ $order->id }}">
                            <div style="padding-top: 10px; border-top: 1px solid rgba(139,94,60,0.05); margin-top: 5px;">
                                @foreach($order->items as $item)
                                    <div class="order-item-row">
                                        <div class="item-qty-name">
                                            <span class="item-qty">{{ $item->quantity }}x</span>
                                            <span style="font-weight:500;">{{ $item->name }}</span>
                                        </div>
                                        <div style="font-weight:600;color:#8B6B52;">
                                            RM {{ number_format($item->price * $item->quantity, 2) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <script>
        function toggleItems(orderId, toggleElement) {
            const listWrap = document.getElementById('items-list-' + orderId);
            const chevron = toggleElement.querySelector('.chevron');
            
            if (listWrap.classList.contains('open')) {
                listWrap.classList.remove('open');
                listWrap.style.maxHeight = '0';
                chevron.textContent = '▼';
            } else {
                listWrap.classList.add('open');
                listWrap.style.maxHeight = listWrap.scrollHeight + 'px';
                chevron.textContent = '▲';
            }
        }
    </script>
</body>
</html>
