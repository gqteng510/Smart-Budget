<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Menu – Admin</title>
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

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #8B5E3C, #B87346);
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 6px 18px rgba(139,94,60,0.4);
            transition: transform 0.15s, box-shadow 0.15s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(139,94,60,0.5);
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
            animation: fadeUp 0.3s ease-out;
        }
        .alert-success {
            background: rgba(52,168,83,0.12);
            border: 1px solid rgba(52,168,83,0.25);
            color: #6FCF97;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── STATS CARDS ── */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
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
            padding: 14px 20px;
            font-size: 0.88rem;
            color: rgba(232,213,196,0.85);
            vertical-align: middle;
        }

        .td-thumb {
            width: 48px; height: 48px;
            border-radius: 10px;
            object-fit: cover;
            background: rgba(184,115,70,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            overflow: hidden;
            flex-shrink: 0;
        }
        .td-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .td-name {
            font-weight: 600;
            color: #E8D5C4;
        }

        .category-pill {
            display: inline-block;
            background: rgba(139,94,60,0.2);
            color: #D4956A;
            font-size: 0.75rem;
            font-weight: 500;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .price-cell {
            font-weight: 700;
            color: #E8A96A;
        }

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn-edit {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: rgba(59,130,246,0.12);
            border: 1px solid rgba(59,130,246,0.2);
            color: #93C5FD;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.15s;
        }
        .btn-edit:hover {
            background: rgba(59,130,246,0.2);
            border-color: rgba(59,130,246,0.4);
        }

        .btn-delete {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.18);
            color: #FCA5A5;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.15s;
        }
        .btn-delete:hover {
            background: rgba(239,68,68,0.18);
            border-color: rgba(239,68,68,0.35);
        }

        /* ── EMPTY STATE ── */
        .empty-table {
            text-align: center;
            padding: 60px 20px;
        }
        .empty-table .emoji { font-size: 3rem; display: block; margin-bottom: 12px; }
        .empty-table p { color: rgba(232,213,196,0.4); font-size: 0.9rem; }

        /* Modal overlay */
        .modal-overlay {
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.7);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 999;
        }
        .modal-overlay.show { display: flex; }

        .modal-box {
            background: #2C1504;
            border: 1px solid rgba(239,68,68,0.25);
            border-radius: 16px;
            padding: 32px;
            max-width: 400px;
            width: 90%;
            text-align: center;
            animation: fadeUp 0.25s ease-out;
        }
        .modal-box .modal-icon { font-size: 2.5rem; margin-bottom: 12px; }
        .modal-box h3 { font-size: 1.2rem; color: #F5E9DC; margin-bottom: 8px; }
        .modal-box p { font-size: 0.88rem; color: rgba(232,213,196,0.6); margin-bottom: 24px; }
        .modal-actions { display: flex; gap: 12px; justify-content: center; }
        .btn-cancel {
            padding: 10px 24px;
            border-radius: 8px;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.12);
            color: rgba(232,213,196,0.7);
            font-family: 'Inter', sans-serif;
            font-size: 0.88rem;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-cancel:hover { background: rgba(255,255,255,0.12); }
        .btn-confirm-delete {
            padding: 10px 24px;
            border-radius: 8px;
            background: rgba(239,68,68,0.2);
            border: 1px solid rgba(239,68,68,0.35);
            color: #FCA5A5;
            font-family: 'Inter', sans-serif;
            font-size: 0.88rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-confirm-delete:hover { background: rgba(239,68,68,0.3); }

        .admin-filter-bar {
            display: flex;
            gap: 16px;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            background: rgba(255,255,255,0.02);
            border: 1px solid rgba(184,115,70,0.12);
            padding: 16px;
            border-radius: 14px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .filter-label {
            font-size: 0.72rem;
            color: rgba(232,213,196,0.4);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
        }

        .filter-input {
            background: rgba(0,0,0,0.2);
            border: 1px solid rgba(184,115,70,0.25);
            color: #E8D5C4;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 0.88rem;
            font-family: 'Inter', sans-serif;
            width: 250px;
            outline: none;
            transition: border-color 0.2s;
        }
        .filter-input:focus {
            border-color: #E8A96A;
        }

        .filter-select {
            background: rgba(0,0,0,0.2);
            border: 1px solid rgba(184,115,70,0.25);
            color: #E8D5C4;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 0.88rem;
            font-family: 'Inter', sans-serif;
            width: 180px;
            outline: none;
            cursor: pointer;
            transition: border-color 0.2s;
        }
        .filter-select:focus {
            border-color: #E8A96A;
        }

        .filter-select option {
            background: #2C1504;
            color: #E8D5C4;
        }

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
            <div class="sidebar-avatar" style="background:#fff; padding:6px; display:flex; align-items:center; justify-content:center; overflow:hidden;"><img src="{{ asset('images/logo.png') }}" style="width:100%; height:100%; object-fit:contain;" alt="Logo"></div>
            <h2>Admin Panel</h2>
            <p>{{ auth()->user()->name }}</p>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('menu.manage') }}" class="nav-item active">
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
                <h1 class="page-title">Menu Management</h1>
                <p class="page-subtitle">Add, edit and remove items from your menu</p>
            </div>
            <a href="{{ route('menu.create') }}" id="btn-add-item" class="btn-primary">
                <span>➕</span> Add New Item
            </a>
        </div>

        <!-- Alert -->
        @if(session('success'))
            <div class="alert alert-success">
                <span>✅</span> {{ session('success') }}
            </div>
        @endif

        <!-- Stats -->
        @php
            $categories = $menus->pluck('category')->unique()->filter()->count();
            $avgPrice   = $menus->count() ? $menus->avg('price') : 0;
        @endphp
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon">🍽️</div>
                <div class="stat-value">{{ $menus->count() }}</div>
                <div class="stat-label">Total Items</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🗂️</div>
                <div class="stat-value">{{ $categories }}</div>
                <div class="stat-label">Categories</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">💰</div>
                <div class="stat-value">RM {{ number_format($avgPrice, 0) }}</div>
                <div class="stat-label">Avg. Price</div>
            </div>
        </div>

        <!-- Filter Bar -->
        @php
            $uniqueCategories = $menus->pluck('category')->unique()->filter()->values();
        @endphp
        <div class="admin-filter-bar">
            <div class="filter-group">
                <label class="filter-label" for="search-input">Search Name</label>
                <input type="text" id="search-input" class="filter-input" placeholder="Search dish name..." oninput="applyFilters()">
            </div>
            
            <div class="filter-group">
                <label class="filter-label" for="category-select">Category</label>
                <select id="category-select" class="filter-select" onchange="applyFilters()">
                    <option value="all">All Categories</option>
                    @foreach($uniqueCategories as $cat)
                        <option value="{{ Str::slug($cat) }}">{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Table -->
        <div class="table-card">
            <div class="table-header">
                <h3>All Menu Items</h3>
                <span class="item-count">{{ $menus->count() }} items</span>
            </div>

            @if($menus->isEmpty())
                <div class="empty-table">
                    <span class="emoji">🍽️</span>
                    <p>No menu items yet. Add your first item!</p>
                </div>
            @else
                <table>
                    <thead>
                        <tr>
                            <th style="width:60px;">#</th>
                            <th style="width:60px;">Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menus as $index => $menu)
                        <tr class="menu-row" data-category="{{ Str::slug($menu->category) }}" data-name="{{ strtolower($menu->name) }}">
                            <td style="color:rgba(232,213,196,0.35);">{{ $index + 1 }}</td>
                            <td>
                                <div class="td-thumb">
                                    @if($menu->image)
                                        <img src="{{ asset('images/' . $menu->image) }}" alt="{{ $menu->name }}">
                                    @else
                                        🍜
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="td-name">{{ $menu->name }}</div>
                                @if($menu->description)
                                    <div style="font-size:0.76rem;color:rgba(232,213,196,0.35);margin-top:2px;max-width:240px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                                        {{ $menu->description }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if($menu->category)
                                    <span class="category-pill">{{ $menu->category }}</span>
                                @else
                                    <span style="opacity:0.3;">—</span>
                                @endif
                            </td>
                            <td class="price-cell">RM {{ number_format($menu->price, 2) }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('menu.edit', $menu) }}" class="btn-edit" id="btn-edit-{{ $menu->id }}">
                                        ✏️ Edit
                                    </a>
                                    <button
                                        type="button"
                                        class="btn-delete"
                                        id="btn-delete-{{ $menu->id }}"
                                        onclick="confirmDelete({{ $menu->id }}, '{{ addslashes($menu->name) }}')"
                                    >
                                        🗑️ Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- Delete Confirm Modal -->
    <div class="modal-overlay" id="delete-modal">
        <div class="modal-box">
            <div class="modal-icon">⚠️</div>
            <h3>Delete Menu Item?</h3>
            <p id="modal-item-name">This action cannot be undone.</p>
            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
                <form id="delete-form" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="btn-confirm-delete" class="btn-confirm-delete">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function applyFilters() {
            const searchVal = document.getElementById('search-input').value.toLowerCase().trim();
            const catVal = document.getElementById('category-select').value;
            const rows = document.querySelectorAll('.menu-row');
            let visibleCount = 0;

            rows.forEach(row => {
                const name = row.dataset.name;
                const category = row.dataset.category;

                const matchesSearch = name.includes(searchVal);
                const matchesCat = (catVal === 'all' || category === catVal);

                if (matchesSearch && matchesCat) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Update item count badge
            const countBadge = document.querySelector('.item-count');
            if (countBadge) {
                countBadge.textContent = visibleCount + (visibleCount === 1 ? ' item' : ' items');
            }
        }

        function confirmDelete(id, name) {
            document.getElementById('modal-item-name').textContent =
                'Are you sure you want to delete "' + name + '"? This cannot be undone.';
            document.getElementById('delete-form').action = '/menu/' + id;
            document.getElementById('delete-modal').classList.add('show');
        }
        function closeModal() {
            document.getElementById('delete-modal').classList.remove('show');
        }
        document.getElementById('delete-modal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });
    </script>
</body>
</html>
