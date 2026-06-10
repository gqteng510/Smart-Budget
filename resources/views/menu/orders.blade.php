<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders – Admin</title>
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
            position: fixed;
            top: 0; left: 0;
            width: 240px;
            height: 100vh;
            background: linear-gradient(180deg, #2C1504 0%, #1A0F08 100%);
            border-right: 1px solid rgba(184,115,70,0.15);
            display: flex;
            flex-direction: column;
            padding: 0 0 24px;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 28px 24px 24px;
            border-bottom: 1px solid rgba(184,115,70,0.12);
            margin-bottom: 16px;
        }

        .sidebar-brand h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            color: #E8A96A;
            line-height: 1.2;
        }
        .sidebar-brand p {
            font-size: 0.75rem;
            color: rgba(232,213,196,0.45);
            margin-top: 4px;
        }

        .sidebar-avatar {
            width: 38px; height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #8B5E3C, #B87346);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            margin-bottom: 10px;
            box-shadow: 0 4px 12px rgba(139,94,60,0.4);
        }

        .sidebar-nav {
            flex: 1;
            padding: 0 12px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 14px;
            border-radius: 10px;
            color: rgba(232,213,196,0.65);
            font-size: 0.88rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            margin-bottom: 4px;
        }
        .nav-item:hover {
            background: rgba(184,115,70,0.12);
            color: #E8D5C4;
        }
        .nav-item.active {
            background: linear-gradient(135deg, rgba(139,94,60,0.3), rgba(184,115,70,0.2));
            color: #E8A96A;
            border: 1px solid rgba(184,115,70,0.2);
        }

        .sidebar-footer {
            padding: 0 12px;
        }

        .btn-logout-side {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 11px 14px;
            background: rgba(220,80,60,0.08);
            border: 1px solid rgba(220,80,60,0.15);
            color: rgba(240,130,110,0.8);
            border-radius: 10px;
            font-size: 0.88rem;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-logout-side:hover {
            background: rgba(220,80,60,0.15);
            color: #F08070;
            border-color: rgba(220,80,60,0.3);
        }

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

        /* ── ALERT ── */
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
            color: #6FCF97;
        }

        /* ── STATS CARDS ── */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(184,115,70,0.12);
            border-radius: 14px;
            padding: 20px;
            transition: background 0.2s;
        }
        .stat-card:hover { background: rgba(255,255,255,0.07); }

        .stat-icon { font-size: 1.5rem; margin-bottom: 8px; }
        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: #E8A96A;
            line-height: 1;
            margin-bottom: 4px;
        }
        .stat-label {
            font-size: 0.78rem;
            color: rgba(232,213,196,0.45);
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        /* ── TABLE ── */
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
            font-size: 1rem;
            font-weight: 600;
            color: #E8D5C4;
        }
        .item-count {
            background: rgba(184,115,70,0.15);
            color: #E8A96A;
            font-size: 0.78rem;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
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
            padding: 18px 20px;
            font-size: 0.88rem;
            color: rgba(232,213,196,0.85);
            vertical-align: top;
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

        /* Items breakdown list */
        .ordered-items-list {
            list-style: none;
            padding: 0;
            margin-top: 4px;
        }
        .ordered-item-li {
            font-size: 0.8rem;
            color: rgba(232,213,196,0.6);
            padding: 2px 0;
            display: flex;
            gap: 6px;
        }
        .item-count-badge {
            color: #E8A96A;
            font-weight: 700;
        }

        /* Action buttons */
        .actions-col {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
            width: 100%;
        }

        .btn-action.accepted {
            background: #1890ff;
            color: #fff;
        }
        .btn-action.accepted:hover:not(:disabled) { background: #096dd9; }

        .btn-action.completed {
            background: #52c41a;
            color: #fff;
        }
        .btn-action.completed:hover:not(:disabled) { background: #389e0d; }

        .btn-action.cancelled {
            background: #f5222d;
            color: #fff;
        }
        .btn-action.cancelled:hover:not(:disabled) { background: #cf1322; }

        .btn-action:disabled {
            background: rgba(255,255,255,0.05) !important;
            border: 1px solid rgba(255,255,255,0.08) !important;
            color: rgba(232,213,196,0.2) !important;
            cursor: not-allowed;
            transform: none !important;
            box-shadow: none !important;
        }

        /* ── EMPTY STATE ── */
        .empty-table {
            text-align: center;
            padding: 60px 20px;
        }
        .empty-table .emoji { font-size: 3rem; display: block; margin-bottom: 12px; }
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
            <div class="sidebar-avatar">👨‍🍳</div>
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
            <a href="{{ route('admin.orders') }}" class="nav-item active">
                <span>🛒</span> Manage Orders
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
                <h1 class="page-title">Manage Customer Orders</h1>
                <p class="page-subtitle">Track, confirm, and update the status of customer bookings</p>
            </div>
        </div>

        <!-- Alert -->
        @if(session('success'))
            <div class="alert alert-success">
                <span>✅</span> {{ session('success') }}
            </div>
        @endif

        <!-- Stats row -->
        @php
            $pendingCount = $orders->where('status', 'pending')->count();
            $acceptedCount = $orders->where('status', 'accepted')->count();
            $completedCount = $orders->where('status', 'completed')->count();
            $totalSales = $orders->whereIn('status', ['accepted', 'completed'])->sum('total_price');
        @endphp
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon">⌛</div>
                <div class="stat-value" style="color: #F2994A;">{{ $pendingCount }}</div>
                <div class="stat-label">Pending</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🔵</div>
                <div class="stat-value" style="color: #1890ff;">{{ $acceptedCount }}</div>
                <div class="stat-label">Accepted</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-value" style="color: #52C41A;">{{ $completedCount }}</div>
                <div class="stat-label">Completed</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">💰</div>
                <div class="stat-value">RM {{ number_format($totalSales, 2) }}</div>
                <div class="stat-label">Earnings</div>
            </div>
        </div>

        <!-- Table -->
        <div class="table-card">
            <div class="table-header">
                <h3>All Bookings</h3>
                <span class="item-count">{{ $orders->count() }} orders</span>
            </div>

            @if($orders->isEmpty())
                <div class="empty-table">
                    <span class="emoji">🛒</span>
                    <p>No orders have been placed by customers yet.</p>
                </div>
            @else
                <table>
                    <thead>
                        <tr>
                            <th style="width:70px;">Order #</th>
                            <th style="width:200px;">Customer</th>
                            <th>Pax / Total Budget</th>
                            <th style="width:280px;">Items Ordered</th>
                            <th>Total Price</th>
                            <th style="width:100px;">Status</th>
                            <th style="width:160px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td class="td-bold">#{{ sprintf('%05d', $order->id) }}</td>
                            <td>
                                <div class="td-bold">{{ $order->user->name }}</div>
                                <div style="font-size:0.75rem;color:rgba(232,213,196,0.45);margin-top:2px;">{{ $order->user->email }}</div>
                                <div style="font-size:0.75rem;color:rgba(232,213,196,0.35);margin-top:2px;">{{ $order->created_at->format('d/m/Y h:i A') }}</div>
                            </td>
                            <td>
                                <div><span class="td-bold">{{ $order->pax }}</span> pax</div>
                                <div style="font-size:0.78rem;color:rgba(232,213,196,0.45);margin-top:2px;">Limit: RM {{ number_format($order->budget, 2) }}</div>
                            </td>
                            <td>
                                <ul class="ordered-items-list">
                                    @foreach($order->items as $item)
                                        <li class="ordered-item-li">
                                            <span class="item-count-badge">{{ $item->quantity }}x</span>
                                            <span>{{ $item->name }}</span>
                                            <span style="opacity:0.4;font-size:0.75rem;">(RM {{ number_format($item->price, 0) }})</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="price-cell">RM {{ number_format($order->total_price, 2) }}</td>
                            <td>
                                <span class="status-badge {{ $order->status }}" id="admin-status-{{ $order->id }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td>
                                <div class="actions-col">
                                    <!-- Accepted Button -->
                                    <form action="{{ route('admin.orders.status', $order) }}" method="POST" style="margin:0; width:100%;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="accepted">
                                        <button type="submit" class="btn-action accepted" id="btn-accepted-{{ $order->id }}" 
                                            {{ $order->status === 'pending' ? '' : 'disabled' }}>
                                            ✓ Accepted
                                        </button>
                                    </form>

                                    <!-- Completed Button -->
                                    <form action="{{ route('admin.orders.status', $order) }}" method="POST" style="margin:0; width:100%;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="completed">
                                        <button type="submit" class="btn-action completed" id="btn-completed-{{ $order->id }}" 
                                            {{ $order->status === 'accepted' ? '' : 'disabled' }}>
                                            ✓ Completed
                                        </button>
                                    </form>

                                    <!-- Cancelled Button -->
                                    <form action="{{ route('admin.orders.status', $order) }}" method="POST" style="margin:0; width:100%;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="btn-action cancelled" id="btn-cancel-{{ $order->id }}" 
                                            {{ $order->status === 'pending' ? '' : 'disabled' }}>
                                            ✗ Cancelled
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

</body>
</html>
