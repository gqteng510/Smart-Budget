<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders – Ezzati Catering</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: #F5E9DC;
            min-height: 100vh;
            color: #3D2010;
            display: flex;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: 260px;
            background: #ffffff;
            border-right: 1px solid rgba(139,94,60,0.15);
            display: flex;
            flex-direction: column;
            padding: 24px 0;
            height: 100vh;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 24px 20px;
            border-bottom: 1px solid rgba(139,94,60,0.08);
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-info h2 {
            font-size: 0.95rem;
            font-weight: 700;
            color: #3D2010;
            line-height: 1.2;
        }
        .brand-info p {
            font-size: 0.72rem;
            color: #8B6B52;
            font-weight: 500;
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 20px 24px;
            border-bottom: 1px solid rgba(139,94,60,0.08);
            margin-bottom: 16px;
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            background: #EDD5BE;
            color: #8B5E3C;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 2px 8px rgba(139,94,60,0.15);
        }

        .user-info {
            overflow: hidden;
        }
        .user-info h3 {
            font-size: 0.88rem;
            font-weight: 700;
            color: #3D2010;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .user-info p {
            font-size: 0.72rem;
            color: #8B6B52;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-nav {
            flex: 1;
            padding: 0 16px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 10px;
            color: #5C3D1E;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            margin-bottom: 4px;
        }
        .nav-item:hover {
            background: #F5E9DC;
            color: #3D2010;
        }
        .nav-item.active {
            background: #EDD5BE;
            color: #6B3E1E;
            font-weight: 600;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.5);
            border: 1px solid rgba(139,94,60,0.1);
        }

        .sidebar-footer {
            padding: 0 16px;
        }

        .btn-logout-side {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            padding: 12px 16px;
            background: transparent;
            border: none;
            color: #8B6B52;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
            text-align: left;
        }
        .btn-logout-side:hover {
            background: rgba(198,40,40,0.06);
            color: #c62828;
        }

        /* ── MAIN LAYOUT ── */
        .main {
            margin-left: 260px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ── TOP BREADCRUMB BAR ── */
        .top-bar {
            height: 70px;
            background: #ffffff;
            border-bottom: 1px solid rgba(139,94,60,0.15);
            display: flex;
            align-items: center;
            padding: 0 40px;
        }

        .top-bar h2 {
            font-size: 1.05rem;
            font-weight: 700;
            color: #3D2010;
        }

        /* ── MAIN CONTENT ── */
        .main-content {
            padding: 40px;
            flex: 1;
            max-width: 1200px;
            width: 100%;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #3D2010;
            line-height: 1.2;
        }

        .page-subtitle {
            font-size: 0.88rem;
            color: #8B6B52;
            margin-top: 4px;
            font-weight: 500;
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
            background: rgba(52,168,83,0.12);
            border: 1px solid rgba(52,168,83,0.25);
            color: #2e7d32;
        }

        /* ── STATUS FILTER PILLS ── */
        .filter-bar {
            display: flex;
            gap: 12px;
            margin: 24px 0 28px;
            flex-wrap: wrap;
        }

        .pill-btn {
            background: #ffffff;
            border: 1px solid rgba(139,94,60,0.25);
            color: #5C3D1E;
            padding: 8px 20px;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 2px 6px rgba(139,94,60,0.04);
        }

        .pill-btn:hover {
            background: rgba(139,94,60,0.05);
            border-color: #8B5E3C;
        }

        .pill-btn.active {
            background: linear-gradient(135deg, #8B5E3C, #B87346);
            color: #ffffff;
            border-color: transparent;
            box-shadow: 0 4px 12px rgba(139,94,60,0.25);
        }

        /* ── ORDER CARD ── */
        .order-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 20px;
            box-shadow: 0 4px 16px rgba(139,94,60,0.06);
            border: 1px solid rgba(139,94,60,0.1);
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(139,94,60,0.08);
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

        .badge {
            font-size: 0.75rem;
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

        .detail-label {
            font-size: 0.72rem;
            color: #8B6B52;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 2px;
        }

        .detail-value {
            font-size: 0.95rem;
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

        /* ── EMPTY STATE CARD ── */
        .empty-state-card {
            background: #ffffff;
            border: 1px solid rgba(139,94,60,0.15);
            border-radius: 16px;
            padding: 60px 40px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(139,94,60,0.06);
            display: none;
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            background: rgba(139,94,60,0.05);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: #8B5E3C;
        }

        .clipboard-svg {
            width: 38px;
            height: 38px;
        }

        .empty-state-card h3 {
            font-size: 1.15rem;
            font-weight: 700;
            color: #3D2010;
            margin-bottom: 6px;
        }

        .empty-state-card p {
            font-size: 0.9rem;
            color: #8B6B52;
            margin-bottom: 20px;
        }

        .btn-browse {
            display: inline-block;
            background: linear-gradient(135deg, #8B5E3C, #B87346);
            color: #ffffff;
            padding: 10px 24px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(139,94,60,0.3);
            transition: all 0.2s;
        }

        .btn-browse:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(139,94,60,0.4);
        }

        /* ── RESPONSIVE DESIGN ── */
        @media (max-width: 768px) {
            body { flex-direction: column; }
            .sidebar { width: 100%; height: auto; position: relative; border-right: none; border-bottom: 1px solid rgba(139,94,60,0.15); }
            .main { margin-left: 0; }
            .top-bar { padding: 0 24px; }
            .main-content { padding: 24px; }
            .order-details-grid { grid-template-columns: 1fr; gap: 10px; }
        }
    </style>
</head>
<body>

    @php
        $userName = auth()->user()->name;
        $userEmail = auth()->user()->email;
        $initial = strtoupper(substr($userName, 0, 1));

        $allCount = $orders->count();
        $pendingCount = $orders->where('status', 'pending')->count();
        $acceptedCount = $orders->where('status', 'accepted')->count();
        $completedCount = $orders->where('status', 'completed')->count();
        $cancelledCount = $orders->where('status', 'cancelled')->count();
    @endphp

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon"><img src="{{ asset('images/logo.png') }}" style="width:100%; height:100%; object-fit:contain;" alt="Logo"></div>
            <div class="brand-info">
                <h2>Ezzati Catering</h2>
                <p>Customer Portal</p>
            </div>
        </div>

        <div class="sidebar-user">
            <div class="user-avatar">{{ $initial }}</div>
            <div class="user-info">
                <h3>{{ $userName }}</h3>
                <p title="{{ $userEmail }}">{{ $userEmail }}</p>
            </div>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="nav-item">
                <span style="font-size: 1.1rem;">📊</span> Dashboard
            </a>
            <a href="{{ route('menu.pax') }}" class="nav-item">
                <span style="font-size: 1.1rem;">🛒</span> Order Now
            </a>
            <a href="{{ route('orders.index') }}" class="nav-item active">
                <span style="font-size: 1.1rem;">📋</span> My Orders
            </a>
            <a href="{{ route('profile.edit') }}" class="nav-item">
                <span style="font-size: 1.1rem;">👤</span> Profile
            </a>
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout-side">
                    <span style="font-size: 1.1rem;">🚪</span> Sign Out
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN AREA -->
    <main class="main">
        <!-- TOP BREADCRUMB BAR -->
        <div class="top-bar">
            <h2>My Orders</h2>
        </div>

        <!-- MAIN CONTENT -->
        <div class="main-content">
            @if(session('success'))
                <div class="alert">
                    <span>✅</span> {{ session('success') }}
                </div>
            @endif

            <h1 class="page-title">My Orders</h1>
            <p class="page-subtitle">Track your catering orders</p>

            <!-- FILTER PILLS -->
            <div class="filter-bar">
                <button class="pill-btn active" onclick="filterOrders('all', this)" id="pill-all">All ({{ $allCount }})</button>
                <button class="pill-btn" onclick="filterOrders('pending', this)" id="pill-pending">Pending Review ({{ $pendingCount }})</button>
                <button class="pill-btn" onclick="filterOrders('accepted', this)" id="pill-accepted">Accepted ({{ $acceptedCount }})</button>
                <button class="pill-btn" onclick="filterOrders('completed', this)" id="pill-completed">Completed ({{ $completedCount }})</button>
                <button class="pill-btn" onclick="filterOrders('cancelled', this)" id="pill-cancelled">Cancelled ({{ $cancelledCount }})</button>
            </div>

            <!-- ORDERS LIST -->
            <div id="orders-list-container">
                @foreach($orders as $order)
                    <div class="order-card" id="order-card-{{ $order->id }}" data-status="{{ $order->status }}">
                        <div class="order-header">
                            <div>
                                <span class="order-ref">Order #{{ sprintf('%05d', $order->id) }}</span>
                                <span class="order-date">{{ $order->created_at->format('M d, Y h:i A') }}</span>
                            </div>
                            <span class="badge {{ $order->status }}" id="order-status-{{ $order->id }}">
                                @if($order->status === 'pending')
                                    Pending Review
                                @elseif($order->status === 'completed')
                                    Completed
                                @else
                                    {{ ucfirst($order->status) }}
                                @endif
                            </span>
                        </div>

                        <!-- Details Grid -->
                        <div class="order-details-grid">
                            <div>
                                <div class="detail-label">Pax Size</div>
                                <div class="detail-value">{{ $order->pax }} pax</div>
                            </div>
                            <div>
                                <div class="detail-label">Total Budget Limit</div>
                                <div class="detail-value">RM {{ number_format($order->budget, 2) }}</div>
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
            </div>

            <!-- EMPTY STATE CARD -->
            <div class="empty-state-card" id="no-orders-filter">
                <div class="empty-icon">
                    <svg class="clipboard-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                        <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                        <path d="M9 14h6"></path>
                        <path d="M9 10h6"></path>
                        <path d="M9 18h6"></path>
                    </svg>
                </div>
                <h3>No orders found</h3>
                <p>You haven't placed any orders yet.</p>
                <a href="{{ route('menu.index') }}" class="btn-browse" id="btn-browse-menu">Browse Menu</a>
            </div>
        </div>
    </main>

    <script>
        // Set initial empty state visibility based on PHP data
        document.addEventListener('DOMContentLoaded', () => {
            const hasOrders = {{ $allCount > 0 ? 'true' : 'false' }};
            if (!hasOrders) {
                document.getElementById('no-orders-filter').style.display = 'block';
            }
        });

        function filterOrders(status, button) {
            // Toggle active pill button
            document.querySelectorAll('.pill-btn').forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            let visibleCount = 0;
            // Show/hide order cards
            document.querySelectorAll('.order-card').forEach(card => {
                const cardStatus = card.dataset.status;
                if (status === 'all' || cardStatus === status) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Toggle empty state card
            const emptyState = document.getElementById('no-orders-filter');
            if (visibleCount === 0) {
                emptyState.style.display = 'block';
            } else {
                emptyState.style.display = 'none';
            }
        }

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
