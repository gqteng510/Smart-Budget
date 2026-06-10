<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }}'s Orders – Admin Panel</title>
    <meta name="description" content="View all orders placed by {{ $user->name }}.">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: #1A0A00;
            min-height: 100vh;
            display: flex;
            color: #E8D5C4;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: linear-gradient(180deg, #2C1206 0%, #1A0A00 100%);
            border-right: 1px solid rgba(232,169,106,0.1);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 50;
        }
        .sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(232,169,106,0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            text-align: center;
        }
        .sidebar-avatar {
            width: 64px; height: 64px;
            border-radius: 14px;
            background: #fff;
            padding: 6px;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
        }
        .sidebar-brand h2 { color: #E8D5C4; font-size: 0.95rem; font-weight: 700; }
        .sidebar-brand p  { color: rgba(232,213,196,0.45); font-size: 0.75rem; }

        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            color: rgba(232,213,196,0.6);
            font-size: 0.88rem;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
        }
        .nav-item:hover { background: rgba(232,169,106,0.08); color: #E8D5C4; }
        .nav-item.active { background: rgba(232,169,106,0.15); color: #E8A96A; font-weight: 600; }
        .nav-item span { font-size: 1.05rem; }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(232,169,106,0.1);
        }
        .btn-logout-side {
            width: 100%;
            display: flex; align-items: center; gap: 10px;
            padding: 10px 14px;
            background: none; border: none;
            color: rgba(232,213,196,0.5);
            font-size: 0.88rem; font-family: 'Inter', sans-serif;
            cursor: pointer; border-radius: 10px;
            transition: background 0.2s, color 0.2s;
        }
        .btn-logout-side:hover { background: rgba(198,40,40,0.12); color: #ef9a9a; }

        /* ── MAIN ── */
        .main { margin-left: 240px; flex: 1; padding: 36px 40px 60px; }

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.82rem;
            color: rgba(232,213,196,0.4);
            margin-bottom: 20px;
        }
        .breadcrumb a { color: #E8A96A; text-decoration: none; }
        .breadcrumb a:hover { text-decoration: underline; }
        .breadcrumb span { color: rgba(232,213,196,0.25); }

        /* Page Header */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(232,169,106,0.15);
            flex-wrap: wrap;
            gap: 16px;
        }
        .customer-profile {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .profile-avatar {
            width: 56px; height: 56px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(232,169,106,0.3);
        }
        .profile-initial {
            width: 56px; height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6B3E1E, #8B5E3C);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem; font-weight: 700; color: #E8D5C4;
            flex-shrink: 0;
        }
        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            color: #E8D5C4;
            margin-bottom: 4px;
        }
        .page-subtitle { font-size: 0.85rem; color: rgba(232,213,196,0.45); }

        .btn-back {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 9px 18px;
            background: rgba(232,169,106,0.1);
            border: 1px solid rgba(232,169,106,0.25);
            color: #E8A96A;
            border-radius: 10px;
            font-size: 0.85rem; font-weight: 600;
            text-decoration: none;
            transition: background 0.2s;
        }
        .btn-back:hover { background: rgba(232,169,106,0.2); }

        /* Stats */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 28px;
        }
        .stat-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(232,169,106,0.12);
            border-radius: 14px;
            padding: 18px 20px;
        }
        .stat-icon  { font-size: 1.3rem; margin-bottom: 6px; }
        .stat-value { font-size: 1.45rem; font-weight: 700; color: #E8A96A; }
        .stat-label { font-size: 0.75rem; color: rgba(232,213,196,0.4); text-transform: uppercase; letter-spacing: 0.06em; margin-top: 2px; }

        /* Order Cards */
        .orders-list { display: flex; flex-direction: column; gap: 16px; }

        .order-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(232,169,106,0.12);
            border-radius: 16px;
            overflow: hidden;
            transition: border-color 0.2s;
        }
        .order-card:hover { border-color: rgba(232,169,106,0.25); }

        .order-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 24px;
            border-bottom: 1px solid rgba(232,169,106,0.08);
            cursor: pointer;
            user-select: none;
        }
        .order-meta { display: flex; align-items: center; gap: 20px; flex-wrap: wrap; }
        .order-id   { font-size: 0.82rem; color: rgba(232,213,196,0.4); }
        .order-date { font-size: 0.85rem; color: rgba(232,213,196,0.6); }
        .order-total { font-size: 1rem; font-weight: 700; color: #E8A96A; }
        .order-pax  { font-size: 0.82rem; color: rgba(232,213,196,0.45); }

        /* Status badge */
        .status-badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.78rem;
            font-weight: 600;
            text-transform: capitalize;
        }
        .status-pending  { background: rgba(251,191,36,0.12);  color: #FCD34D; border: 1px solid rgba(251,191,36,0.25);  }
        .status-accepted { background: rgba(52,168,83,0.12);   color: #6FCF97; border: 1px solid rgba(52,168,83,0.25);   }
        .status-completed{ background: rgba(66,133,244,0.12);  color: #93C5FD; border: 1px solid rgba(66,133,244,0.25);  }
        .status-cancelled{ background: rgba(220,80,60,0.12);   color: #FCA5A5; border: 1px solid rgba(220,80,60,0.25);   }

        .chevron { font-size: 0.8rem; color: rgba(232,213,196,0.35); transition: transform 0.25s; }
        .order-card.open .chevron { transform: rotate(180deg); }

        /* Order Body */
        .order-card-body {
            display: none;
            padding: 0 24px 20px;
        }
        .order-card.open .order-card-body { display: block; }

        /* Delivery info */
        .delivery-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin: 14px 0;
            padding: 14px 16px;
            background: rgba(255,255,255,0.03);
            border-radius: 10px;
            border: 1px solid rgba(232,169,106,0.08);
        }
        .delivery-item label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: rgba(232,213,196,0.35);
            display: block;
            margin-bottom: 2px;
        }
        .delivery-item span {
            font-size: 0.87rem;
            color: rgba(232,213,196,0.75);
        }

        /* Items table */
        .items-table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        .items-table th {
            padding: 8px 12px;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: rgba(232,213,196,0.35);
            text-align: left;
            border-bottom: 1px solid rgba(232,169,106,0.08);
        }
        .items-table td {
            padding: 9px 12px;
            font-size: 0.87rem;
            color: rgba(232,213,196,0.7);
            border-bottom: 1px solid rgba(232,169,106,0.05);
        }
        .items-table tr:last-child td { border-bottom: none; }
        .items-table .item-total { color: #E8A96A; font-weight: 600; }

        /* Empty state */
        .empty-state {
            padding: 80px 24px;
            text-align: center;
            color: rgba(232,213,196,0.3);
        }
        .empty-state .emoji { font-size: 3rem; display: block; margin-bottom: 14px; }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main { margin-left: 0; padding: 24px 16px; }
            .stats-row { grid-template-columns: 1fr 1fr; }
            .delivery-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-avatar">
                <img src="{{ asset('images/logo.png') }}" style="width:100%; height:100%; object-fit:contain;" alt="Logo">
            </div>
            <h2>Admin Panel</h2>
            <p>{{ auth()->user()->name }}</p>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('menu.manage') }}" class="nav-item">
                <span>📋</span> Manage Menu
            </a>
            <a href="{{ route('menu.create') }}" class="nav-item">
                <span>➕</span> Add New Item
            </a>
            <a href="{{ route('admin.orders') }}" class="nav-item">
                <span>🛒</span> Manage Orders
            </a>
            <a href="{{ route('customers.index') }}" class="nav-item active">
                <span>👥</span> Customer Info
            </a>
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout-side">
                    <span>🚪</span> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main">

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="{{ route('customers.index') }}">Customer Info</a>
            <span>›</span>
            <span>{{ $user->name }}</span>
        </div>

        <!-- Page Header -->
        <div class="page-header">
            <div class="customer-profile">
                @if($user->avatar)
                    <img src="{{ asset('images/' . $user->avatar) }}" class="profile-avatar" alt="{{ $user->name }}">
                @else
                    <div class="profile-initial">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                @endif
                <div>
                    <h1 class="page-title">{{ $user->name }}</h1>
                    <p class="page-subtitle">{{ $user->email }}{{ $user->phone ? ' · ' . $user->phone : '' }}</p>
                </div>
            </div>
            <a href="{{ route('customers.index') }}" class="btn-back">← Back to Customers</a>
        </div>

        <!-- Stats -->
        @php
            $totalOrders     = $orders->count();
            $totalSpent      = $orders->whereIn('status', ['accepted','completed'])->sum('total_price');
            $pendingCount    = $orders->where('status','pending')->count();
            $completedCount  = $orders->where('status','completed')->count();
        @endphp
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon">📦</div>
                <div class="stat-value">{{ $totalOrders }}</div>
                <div class="stat-label">Total Orders</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">💰</div>
                <div class="stat-value">RM {{ number_format($totalSpent, 0) }}</div>
                <div class="stat-label">Total Spent</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">⏳</div>
                <div class="stat-value">{{ $pendingCount }}</div>
                <div class="stat-label">Pending</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-value">{{ $completedCount }}</div>
                <div class="stat-label">Completed</div>
            </div>
        </div>

        <!-- Orders List -->
        @if($orders->isEmpty())
            <div class="empty-state">
                <span class="emoji">🛒</span>
                <p>{{ $user->name }} hasn't placed any orders yet.</p>
            </div>
        @else
            <div class="orders-list">
                @foreach($orders as $order)
                    <div class="order-card" id="order-card-{{ $order->id }}">
                        <!-- Header (clickable to expand) -->
                        <div class="order-card-header" onclick="toggleOrder({{ $order->id }})">
                            <div class="order-meta">
                                <span class="order-id">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                                <span class="order-date">📅 {{ $order->created_at->format('d M Y, g:i A') }}</span>
                                <span class="order-pax">👥 {{ $order->pax }} pax</span>
                                <span class="order-total">RM {{ number_format($order->total_price, 2) }}</span>
                            </div>
                            <div style="display:flex; align-items:center; gap:12px;">
                                <span class="status-badge status-{{ $order->status }}">
                                    @if($order->status === 'pending')    ⏳
                                    @elseif($order->status === 'accepted')  ✅
                                    @elseif($order->status === 'completed') 🎉
                                    @else                                   ❌
                                    @endif
                                    {{ ucfirst($order->status) }}
                                </span>
                                <span class="chevron">▼</span>
                            </div>
                        </div>

                        <!-- Body (expandable) -->
                        <div class="order-card-body">

                            {{-- Delivery details --}}
                            @if($order->delivery_date || $order->delivery_address)
                                <div class="delivery-grid">
                                    @if($order->delivery_date)
                                        <div class="delivery-item">
                                            <label>📅 Delivery Date</label>
                                            <span>{{ \Carbon\Carbon::parse($order->delivery_date)->format('d M Y') }}</span>
                                        </div>
                                    @endif
                                    @if($order->delivery_time)
                                        <div class="delivery-item">
                                            <label>🕐 Delivery Time</label>
                                            <span>{{ \Carbon\Carbon::parse($order->delivery_time)->format('g:i A') }}</span>
                                        </div>
                                    @endif
                                    @if($order->delivery_address)
                                        <div class="delivery-item" style="grid-column: 1 / -1;">
                                            <label>📍 Delivery Address</label>
                                            <span>{{ $order->delivery_address }}</span>
                                        </div>
                                    @endif
                                    @if($order->special_instructions)
                                        <div class="delivery-item" style="grid-column: 1 / -1;">
                                            <label>📋 Special Instructions</label>
                                            <span>{{ $order->special_instructions }}</span>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            {{-- Items table --}}
                            <table class="items-table">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th style="text-align:center;">Qty</th>
                                        <th style="text-align:right;">Unit Price</th>
                                        <th style="text-align:right;">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td style="text-align:center;">{{ $item->quantity }}</td>
                                            <td style="text-align:right;">RM {{ number_format($item->price, 2) }}</td>
                                            <td class="item-total" style="text-align:right;">
                                                RM {{ number_format($item->price * $item->quantity, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" style="text-align:right; font-weight:700; padding-top:10px; border-top:1px solid rgba(232,169,106,0.15); color:#E8D5C4;">
                                            Total
                                        </td>
                                        <td class="item-total" style="text-align:right; font-size:1rem; padding-top:10px; border-top:1px solid rgba(232,169,106,0.15);">
                                            RM {{ number_format($order->total_price, 2) }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>

    <script>
        function toggleOrder(id) {
            const card = document.getElementById('order-card-' + id);
            card.classList.toggle('open');
        }
    </script>

</body>
</html>
