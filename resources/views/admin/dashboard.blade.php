<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard – Ezzati Catering</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: #1A0F08;
            min-height: 100vh;
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
            z-index: 100;
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

        .sidebar-brand h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            color: #E8A96A;
            font-weight: 700;
            line-height: 1.2;
            letter-spacing: 0.02em;
        }
        .sidebar-brand p {
            color: rgba(232,213,196,0.45);
            font-size: 0.75rem;
            margin-top: 2px;
        }

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
            color: rgba(232,213,196,0.65);
            font-size: 0.88rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            margin-bottom: 4px;
        }
        .nav-item:hover { background: rgba(232,169,106,0.08); color: #E8D5C4; }
        .nav-item.active {
            background: rgba(232,169,106,0.15);
            color: #E8A96A;
            font-weight: 600;
        }
        .nav-item span { font-size: 1.05rem; }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(232,169,106,0.1);
        }
        .btn-logout-side {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            background: none;
            border: none;
            color: rgba(232,213,196,0.5);
            font-size: 0.88rem;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            border-radius: 10px;
            transition: background 0.2s, color 0.2s;
            text-align: left;
        }
        .btn-logout-side:hover { background: rgba(198,40,40,0.12); color: #ef9a9a; }

        /* ── MAIN CONTENT ── */
        .main {
            margin-left: 240px;
            padding: 40px 40px 60px;
            min-height: 100vh;
        }

        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: #F5E9DC;
            line-height: 1.2;
        }
        .page-subtitle {
            color: rgba(232,213,196,0.5);
            font-size: 0.88rem;
            margin-top: 4px;
        }

        /* ── STATS CARDS ── */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(184,115,70,0.12);
            border-radius: 14px;
            padding: 24px;
            transition: background 0.2s, transform 0.2s;
        }
        .stat-card:hover { 
            background: rgba(255,255,255,0.07);
            transform: translateY(-2px);
        }

        .stat-icon { font-size: 1.8rem; margin-bottom: 12px; }
        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #E8A96A;
            line-height: 1;
            margin-bottom: 6px;
        }
        .stat-label {
            font-size: 0.78rem;
            color: rgba(232,213,196,0.45);
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        /* ── SECTION LAYOUT ── */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
            margin-top: 10px;
        }

        @media (max-width: 1024px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ── TABLE CARD ── */
        .table-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(184,115,70,0.12);
            border-radius: 16px;
            overflow: hidden;
        }

        .table-header {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(184,115,70,0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .table-header h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #E8D5C4;
        }
        .view-all-link {
            color: #E8A96A;
            font-size: 0.85rem;
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.2s;
        }
        .view-all-link:hover {
            opacity: 0.8;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            padding: 12px 20px;
            text-align: left;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: rgba(232,213,196,0.4);
            background: rgba(0,0,0,0.15);
            border-bottom: 1px solid rgba(184,115,70,0.08);
        }

        tbody tr {
            border-bottom: 1px solid rgba(184,115,70,0.06);
            transition: background 0.15s;
        }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: rgba(184,115,70,0.05); }

        tbody td {
            padding: 16px 20px;
            font-size: 0.88rem;
            color: rgba(232,213,196,0.85);
            vertical-align: middle;
        }

        .td-bold {
            font-weight: 600;
            color: #E8D5C4;
        }

        .price-cell {
            font-weight: 700;
            color: #E8A96A;
        }

        /* Status badges */
        .status-badge {
            display: inline-block;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .status-badge.pending {
            background: rgba(242,153,74,0.15);
            color: #E28743;
            border: 1px solid rgba(242,153,74,0.25);
        }
        .status-badge.accepted {
            background: rgba(24, 144, 255, 0.15);
            color: #40a9ff;
            border: 1px solid rgba(24, 144, 255, 0.25);
        }
        .status-badge.completed {
            background: rgba(82,196,26,0.15);
            color: #73D13D;
            border: 1px solid rgba(82,196,26,0.25);
        }
        .status-badge.cancelled {
            background: rgba(239,68,68,0.12);
            color: #FFA39E;
            border: 1px solid rgba(239,68,68,0.25);
        }

        /* ── BREAKDOWN CARD ── */
        .breakdown-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(184,115,70,0.12);
            border-radius: 16px;
            padding: 24px;
        }
        .breakdown-card h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #E8D5C4;
            margin-bottom: 20px;
            border-bottom: 1px solid rgba(184,115,70,0.1);
            padding-bottom: 12px;
        }
        .breakdown-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .breakdown-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .breakdown-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.88rem;
            color: rgba(232,213,196,0.7);
        }
        .breakdown-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }
        .breakdown-value {
            font-weight: 700;
            font-size: 1rem;
        }

        /* ── EMPTY STATE ── */
        .empty-table {
            text-align: center;
            padding: 40px 20px;
        }
        .empty-table .emoji { font-size: 2.5rem; display: block; margin-bottom: 12px; }
        .empty-table p { color: rgba(232,213,196,0.4); font-size: 0.9rem; }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main { margin-left: 0; padding: 24px 16px; }
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
            <a href="{{ route('admin.dashboard') }}" class="nav-item active" id="nav-admin-dashboard">
                <span>📊</span> Dashboard
            </a>
            <a href="{{ route('menu.manage') }}" class="nav-item">
                <span>📋</span> Manage Menu
            </a>
            <a href="{{ route('menu.create') }}" class="nav-item">
                <span>➕</span> Add New Item
            </a>
            <a href="{{ route('admin.orders') }}" class="nav-item" id="nav-manage-orders">
                <span>🛒</span> Manage Orders
            </a>
            <a href="{{ route('customers.index') }}" class="nav-item" id="nav-customer-info">
                <span>👥</span> Customer Info
            </a>
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" id="btn-admin-logout" class="btn-logout-side">
                    <span>🚪</span> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Dashboard</h1>
                <p class="page-subtitle">Overview of catering orders and business analytics</p>
            </div>
        </div>

        <!-- Stats row -->
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon">📦</div>
                <div class="stat-value" id="admin-total-orders">{{ $totalOrdersCount }}</div>
                <div class="stat-label">Total Orders</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">💰</div>
                <div class="stat-value" id="admin-total-earnings">RM {{ number_format($totalEarnings, 2) }}</div>
                <div class="stat-label">Total Earnings</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-value" id="admin-total-customers">{{ $totalCustomersCount }}</div>
                <div class="stat-label">Customers</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🍽️</div>
                <div class="stat-value" id="admin-total-menus">{{ $totalMenuItemsCount }}</div>
                <div class="stat-label">Menu Items</div>
            </div>
        </div>

        <!-- Dashboard Grid -->
        <div class="dashboard-grid">
            <!-- Recent Orders -->
            <div class="table-card">
                <div class="table-header">
                    <h3>Recent Orders</h3>
                    <a href="{{ route('admin.orders') }}" class="view-all-link" id="btn-view-all-orders">View All Orders →</a>
                </div>

                @if($recentOrders->isEmpty())
                    <div class="empty-table">
                        <span class="emoji">🛒</span>
                        <p>No orders placed yet.</p>
                    </div>
                @else
                    <table>
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Total Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                                <tr>
                                    <td class="td-bold">#{{ sprintf('%05d', $order->id) }}</td>
                                    <td>
                                        <div class="td-bold">{{ $order->user->name }}</div>
                                        <div style="font-size:0.75rem;color:rgba(232,213,196,0.45);margin-top:2px;">{{ $order->user->email }}</div>
                                    </td>
                                    <td class="price-cell">RM {{ number_format($order->total_price, 2) }}</td>
                                    <td>
                                        <span class="status-badge {{ $order->status }}" id="recent-status-{{ $order->id }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <!-- Orders Breakdown -->
            <div class="breakdown-card">
                <h3>Order Status Breakdown</h3>
                <div class="breakdown-list">
                    <div class="breakdown-item">
                        <div class="breakdown-label">
                            <span class="breakdown-dot" style="background: #F2994A;"></span>
                            <span>Pending</span>
                        </div>
                        <span class="breakdown-value" id="breakdown-pending">{{ $pendingOrdersCount }}</span>
                    </div>
                    <div class="breakdown-item">
                        <div class="breakdown-label">
                            <span class="breakdown-dot" style="background: #40a9ff;"></span>
                            <span>Accepted</span>
                        </div>
                        <span class="breakdown-value" id="breakdown-accepted">{{ $acceptedOrdersCount }}</span>
                    </div>
                    <div class="breakdown-item">
                        <div class="breakdown-label">
                            <span class="breakdown-dot" style="background: #73D13D;"></span>
                            <span>Completed</span>
                        </div>
                        <span class="breakdown-value" id="breakdown-completed">{{ $completedOrdersCount }}</span>
                    </div>
                    <div class="breakdown-item">
                        <div class="breakdown-label">
                            <span class="breakdown-dot" style="background: #FFA39E;"></span>
                            <span>Cancelled</span>
                        </div>
                        <span class="breakdown-value" id="breakdown-cancelled">{{ $cancelledOrdersCount }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
