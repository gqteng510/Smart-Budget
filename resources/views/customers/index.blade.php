<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Information – Admin Panel</title>
    <meta name="description" content="View all registered customer accounts and their order history.">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: #1A0A00;
            min-height: 100vh;
            display: flex;
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

        /* ── MAIN ── */
        .main {
            margin-left: 240px;
            flex: 1;
            padding: 36px 40px;
            color: #E8D5C4;
        }

        /* Page Header */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(232,169,106,0.15);
        }
        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.7rem;
            color: #E8D5C4;
            margin-bottom: 4px;
        }
        .page-subtitle { font-size: 0.87rem; color: rgba(232,213,196,0.45); }

        /* Stats Row */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 28px;
        }
        .stat-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(232,169,106,0.12);
            border-radius: 14px;
            padding: 20px 24px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .stat-icon { font-size: 1.4rem; margin-bottom: 6px; }
        .stat-value { font-size: 1.6rem; font-weight: 700; color: #E8A96A; }
        .stat-label { font-size: 0.78rem; color: rgba(232,213,196,0.45); text-transform: uppercase; letter-spacing: 0.06em; }

        /* Search bar */
        .filter-bar {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }
        .search-input {
            flex: 1;
            max-width: 360px;
            padding: 10px 16px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(232,169,106,0.2);
            border-radius: 10px;
            color: #E8D5C4;
            font-family: 'Inter', sans-serif;
            font-size: 0.88rem;
            outline: none;
            transition: border-color 0.2s;
        }
        .search-input::placeholder { color: rgba(232,213,196,0.3); }
        .search-input:focus { border-color: #E8A96A; }

        /* Table Card */
        .table-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(232,169,106,0.12);
            border-radius: 16px;
            overflow: hidden;
        }
        .table-header {
            padding: 18px 24px;
            border-bottom: 1px solid rgba(232,169,106,0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .table-header h3 { font-size: 1rem; font-weight: 600; color: #E8D5C4; }
        .customer-count {
            background: rgba(232,169,106,0.15);
            color: #E8A96A;
            padding: 3px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        table { width: 100%; border-collapse: collapse; }
        thead tr { border-bottom: 1px solid rgba(232,169,106,0.1); }
        th {
            padding: 12px 20px;
            text-align: left;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            color: rgba(232,213,196,0.4);
        }
        tbody tr {
            border-bottom: 1px solid rgba(232,169,106,0.06);
            transition: background 0.15s;
        }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: rgba(232,169,106,0.04); }
        td { padding: 14px 20px; font-size: 0.88rem; color: #E8D5C4; vertical-align: middle; }

        /* Avatar cell */
        .avatar-cell { display: flex; align-items: center; gap: 12px; }
        .avatar-img {
            width: 38px; height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(232,169,106,0.25);
        }
        .avatar-placeholder {
            width: 38px; height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6B3E1E, #8B5E3C);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.9rem;
            font-weight: 700;
            color: #E8D5C4;
            flex-shrink: 0;
        }
        .customer-name { font-weight: 600; color: #E8D5C4; }
        .customer-join { font-size: 0.75rem; color: rgba(232,213,196,0.4); margin-top: 2px; }

        /* Order count badge */
        .order-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: rgba(232,169,106,0.12);
            color: #E8A96A;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .order-badge.zero { background: rgba(255,255,255,0.05); color: rgba(232,213,196,0.35); }

        /* Empty state */
        .empty-state {
            padding: 60px 24px;
            text-align: center;
            color: rgba(232,213,196,0.35);
        }
        .empty-state .emoji { font-size: 2.5rem; display: block; margin-bottom: 12px; }

        /* Alert */
        .alert {
            background: rgba(52,168,83,0.1);
            border: 1px solid rgba(52,168,83,0.25);
            color: #81c995;
            border-radius: 10px;
            padding: 12px 18px;
            margin-bottom: 20px;
            font-size: 0.88rem;
        }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main { margin-left: 0; padding: 24px 16px; }
            .stats-row { grid-template-columns: 1fr 1fr; }
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
            <a href="{{ route('admin.dashboard') }}" class="nav-item" id="nav-admin-dashboard">
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
            <a href="{{ route('customers.index') }}" class="nav-item active" id="nav-customer-info">
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

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Customer Information</h1>
                <p class="page-subtitle">All registered customer accounts and their order activity</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert">✅ {{ session('success') }}</div>
        @endif

        <!-- Stats -->
        @php
            $totalCustomers   = $customers->count();
            $withOrders       = $customers->where('orders_count', '>', 0)->count();
            $noOrders         = $totalCustomers - $withOrders;
        @endphp
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-value">{{ $totalCustomers }}</div>
                <div class="stat-label">Total Customers</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🛒</div>
                <div class="stat-value">{{ $withOrders }}</div>
                <div class="stat-label">Customers with Orders</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🆕</div>
                <div class="stat-value">{{ $noOrders }}</div>
                <div class="stat-label">No Orders Yet</div>
            </div>
        </div>

        <!-- Search -->
        <div class="filter-bar">
            <input type="text" id="search-input" class="search-input"
                   placeholder="🔍  Search by name, email or phone…"
                   oninput="filterTable()">
        </div>

        <!-- Table -->
        <div class="table-card">
            <div class="table-header">
                <h3>Registered Customers</h3>
                <span class="customer-count" id="count-badge">{{ $totalCustomers }} customers</span>
            </div>

            @if($customers->isEmpty())
                <div class="empty-state">
                    <span class="emoji">👥</span>
                    <p>No customers have registered yet.</p>
                </div>
            @else
                <table id="customers-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Orders</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $index => $customer)
                            @php $initial = strtoupper(substr($customer->name, 0, 1)); @endphp
                            <tr class="customer-row"
                                data-name="{{ strtolower($customer->name) }}"
                                data-email="{{ strtolower($customer->email) }}"
                                data-phone="{{ $customer->phone }}">
                                <td style="color:rgba(232,213,196,0.3); font-size:0.8rem;">{{ $index + 1 }}</td>
                                <td>
                                    <div class="avatar-cell">
                                        @if($customer->avatar)
                                            <img src="{{ asset('images/' . $customer->avatar) }}"
                                                 class="avatar-img" alt="{{ $customer->name }}">
                                        @else
                                            <div class="avatar-placeholder">{{ $initial }}</div>
                                        @endif
                                        <div>
                                            <div class="customer-name">{{ $customer->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="color:rgba(232,213,196,0.65);">{{ $customer->email }}</td>
                                <td style="color:rgba(232,213,196,0.65);">{{ $customer->phone ?? '—' }}</td>
                                <td style="color:rgba(232,213,196,0.65); max-width:180px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;" title="{{ $customer->address }}">
                                    {{ $customer->address ?? '—' }}
                                </td>
                                <td>
                                    <span class="order-badge {{ $customer->orders_count == 0 ? 'zero' : '' }}">
                                        🛒 {{ $customer->orders_count }}
                                    </span>
                                </td>
                                <td style="color:rgba(232,213,196,0.45); font-size:0.8rem;">
                                    {{ $customer->created_at->format('d M Y') }}
                                </td>
                                <td>
                                    <a href="{{ route('customers.orders', $customer) }}"
                                       id="btn-view-orders-{{ $customer->id }}"
                                       style="display:inline-flex; align-items:center; gap:6px; padding:6px 14px; background:rgba(232,169,106,0.12); border:1px solid rgba(232,169,106,0.25); color:#E8A96A; border-radius:8px; font-size:0.8rem; font-weight:600; text-decoration:none; transition:background 0.2s;"
                                       onmouseover="this.style.background='rgba(232,169,106,0.22)'"
                                       onmouseout="this.style.background='rgba(232,169,106,0.12)'">
                                        📋 View Orders
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>

    <script>
        function filterTable() {
            const q = document.getElementById('search-input').value.toLowerCase().trim();
            const rows = document.querySelectorAll('.customer-row');
            let visible = 0;

            rows.forEach(row => {
                const name  = row.dataset.name;
                const email = row.dataset.email;
                const phone = (row.dataset.phone || '').toLowerCase();
                const match = name.includes(q) || email.includes(q) || phone.includes(q);
                row.style.display = match ? '' : 'none';
                if (match) visible++;
            });

            document.getElementById('count-badge').textContent =
                visible + (visible === 1 ? ' customer' : ' customers');
        }
    </script>

</body>
</html>
