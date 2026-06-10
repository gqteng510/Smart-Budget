<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard – Ezzati Catering</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            background: linear-gradient(135deg, #8B5E3C, #B87346);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 1.25rem;
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

        /* ── MAIN CONTENT ── */
        .main {
            margin-left: 260px;
            flex: 1;
            padding: 40px;
        }

        .dashboard-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #3D2010;
            margin-bottom: 24px;
        }

        /* ── BANNER CARD ── */
        .greeting-banner {
            background: linear-gradient(135deg, #6B3E1E 0%, #8B5E3C 60%, #B87346 100%);
            border-radius: 16px;
            padding: 28px 32px;
            color: #ffffff;
            margin-bottom: 28px;
            box-shadow: 0 6px 20px rgba(139,94,60,0.25);
            position: relative;
            overflow: hidden;
        }
        .greeting-banner::before {
            content: '';
            position: absolute; inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .greeting-banner p {
            font-size: 0.88rem;
            opacity: 0.9;
            margin-bottom: 4px;
            font-weight: 500;
            position: relative;
        }

        .greeting-banner h1 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 6px;
            letter-spacing: -0.01em;
            position: relative;
        }

        .greeting-banner span {
            font-size: 0.88rem;
            opacity: 0.8;
            font-weight: 400;
            position: relative;
        }

        /* ── STATS CARDS ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }

        @media (max-width: 900px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        .stat-card {
            background: #ffffff;
            border: 1px solid rgba(139,94,60,0.15);
            border-radius: 16px;
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 16px;
            box-shadow: 0 4px 12px rgba(139,94,60,0.06);
        }

        .stat-icon-wrap {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .stat-icon-wrap.purple { background: rgba(168,85,247,0.1); color: #a855f7; }
        .stat-icon-wrap.green { background: rgba(139,94,60,0.1); color: #8B5E3C; }
        .stat-icon-wrap.blue { background: rgba(14,165,233,0.1); color: #0ea5e9; }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #3D2010;
            line-height: 1.1;
        }

        .stat-label {
            font-size: 0.8rem;
            color: #8B6B52;
            font-weight: 500;
        }

        /* ── QUICK ACTIONS ── */
        .actions-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: #3D2010;
            margin-bottom: 16px;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        @media (max-width: 768px) {
            .actions-grid {
                grid-template-columns: 1fr;
            }
        }

        .btn-action {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 20px 24px;
            border-radius: 14px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            font-family: 'Inter', sans-serif;
            border: 1px solid transparent;
        }

        .btn-action.primary {
            background: linear-gradient(135deg, #8B5E3C, #B87346);
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(139,94,60,0.3);
        }
        .btn-action.primary:hover {
            background: linear-gradient(135deg, #7A5234, #A66538);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(139,94,60,0.4);
        }

        .btn-action.secondary {
            background: #ffffff;
            border: 1px solid rgba(139,94,60,0.25);
            color: #5C3D1E;
            box-shadow: 0 4px 12px rgba(139,94,60,0.06);
        }
        .btn-action.secondary:hover {
            background: rgba(139,94,60,0.05);
            border-color: #8B5E3C;
            transform: translateY(-2px);
        }

        .btn-action-icon {
            font-size: 1.15rem;
            display: flex;
            align-items: center;
        }

        @media (max-width: 768px) {
            body { flex-direction: column; }
            .sidebar { width: 100%; height: auto; position: relative; border-right: none; border-bottom: 1px solid rgba(139,94,60,0.15); }
            .main { margin-left: 0; padding: 24px; }
        }
    </style>
</head>
<body>

    @php
        $userName = auth()->user()->name;
        $userEmail = auth()->user()->email;
        $initial = strtoupper(substr($userName, 0, 1));
    @endphp

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon" style="background:transparent; display:flex; align-items:center; justify-content:center;"><img src="{{ asset('images/logo.png') }}" style="width:100%; height:100%; object-fit:contain;" alt="Logo"></div>
            <div class="brand-info">
                <h2>Ezzati Catering</h2>
                <p>Customer Portal</p>
            </div>
        </div>

        <div class="sidebar-user">
            @if(auth()->user()->avatar)
                <img src="{{ asset('images/' . auth()->user()->avatar) }}" class="user-avatar" style="object-fit:cover;" alt="Avatar">
            @else
                <div class="user-avatar">{{ $initial }}</div>
            @endif
            <div class="user-info">
                <h3>{{ $userName }}</h3>
                <p title="{{ $userEmail }}">{{ $userEmail }}</p>
            </div>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="nav-item active">
                <span style="font-size: 1.1rem;">📊</span> Dashboard
            </a>
            <a href="{{ route('menu.pax') }}" class="nav-item">
                <span style="font-size: 1.1rem;">🛒</span> Order Now
            </a>
            <a href="{{ route('orders.index') }}" class="nav-item">
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

    <!-- MAIN CONTENT -->
    <main class="main">
        <h1 class="dashboard-title">Dashboard</h1>

        <!-- GREETING BANNER -->
        <div class="greeting-banner">
            <p>Good day,</p>
            <h1>{{ $userName }}</h1>
            @if($totalOrders === 0)
                <span>Ready to place your first order?</span>
            @else
                <span>Ready to place a new order? Keep track of existing ones below.</span>
            @endif
        </div>

        <!-- STATS CARDS GRID -->
        <div class="stats-grid">
            <!-- Total Orders -->
            <div class="stat-card">
                <div class="stat-icon-wrap purple">
                    <span>📋</span>
                </div>
                <div>
                    <div class="stat-value">{{ $totalOrders }}</div>
                    <div class="stat-label">Total Orders</div>
                </div>
            </div>

            <!-- Total Spent -->
            <div class="stat-card">
                <div class="stat-icon-wrap green">
                    <span>💲</span>
                </div>
                <div>
                    <div class="stat-value">RM {{ number_format($totalSpent, 2) }}</div>
                    <div class="stat-label">Total Spent</div>
                </div>
            </div>

            <!-- Completed -->
            <div class="stat-card">
                <div class="stat-icon-wrap blue">
                    <span>✅</span>
                </div>
                <div>
                    <div class="stat-value">{{ $completedOrders }}</div>
                    <div class="stat-label">Completed</div>
                </div>
            </div>
        </div>

        <!-- QUICK ACTIONS -->
        <h2 class="actions-title">Quick Actions</h2>
        <div class="actions-grid">
            <a href="{{ route('menu.pax') }}" class="btn-action primary" id="btn-dashboard-order">
                <span class="btn-action-icon">🛒</span> Place New Order
            </a>
            <a href="{{ route('orders.index') }}" class="btn-action secondary" id="btn-dashboard-view-orders">
                <span class="btn-action-icon">📋</span> View My Orders
            </a>
        </div>
    </main>

</body>
</html>
