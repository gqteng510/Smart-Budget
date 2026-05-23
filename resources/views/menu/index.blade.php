<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Menu</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: #F5E9DC;
            min-height: 100vh;
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
            padding: 48px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute; inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.4rem;
            color: #fff;
            margin-bottom: 12px;
            position: relative;
        }

        .hero p {
            color: rgba(255,255,255,0.75);
            font-size: 0.95rem;
            position: relative;
        }

        /* ── INFO BADGES ── */
        .info-bar {
            display: flex;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
            padding: 20px 40px;
            background: #EDD5BE;
            border-bottom: 1px solid rgba(139,94,60,0.15);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #8B5E3C, #B87346);
            color: #fff;
            padding: 9px 20px;
            border-radius: 50px;
            font-size: 0.88rem;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(139,94,60,0.3);
        }

        .badge-alt {
            background: rgba(255,255,255,0.7);
            color: #5C3D1E;
            border: 1.5px solid rgba(139,94,60,0.25);
            box-shadow: none;
        }

        .badge-icon { font-size: 1rem; }

        /* ── FILTER BAR ── */
        .filter-bar {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            padding: 20px 40px 0;
            justify-content: center;
        }

        .filter-btn {
            background: rgba(255,255,255,0.6);
            border: 1.5px solid rgba(139,94,60,0.2);
            color: #5C3D1E;
            padding: 7px 18px;
            border-radius: 50px;
            font-size: 0.83rem;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
        }
        .filter-btn:hover, .filter-btn.active {
            background: linear-gradient(135deg, #8B5E3C, #B87346);
            color: #fff;
            border-color: transparent;
            box-shadow: 0 4px 12px rgba(139,94,60,0.3);
        }

        /* ── MENU GRID ── */
        .menu-section {
            padding: 32px 40px 60px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 24px;
        }

        .card {
            background: #fff;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(139,94,60,0.1), 0 1px 4px rgba(0,0,0,0.06);
            transition: transform 0.22s, box-shadow 0.22s;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(139,94,60,0.06);
            animation: fadeUp 0.4s ease-out both;
        }
        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 36px rgba(139,94,60,0.18), 0 4px 8px rgba(0,0,0,0.08);
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .card-img-wrap {
            width: 100%;
            height: 190px;
            overflow: hidden;
            background: #EDD5BE;
            position: relative;
        }

        .card-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .card:hover .card-img-wrap img {
            transform: scale(1.07);
        }

        .card-img-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.5rem;
            background: linear-gradient(135deg, #EDD5BE, #DFC4A8);
        }

        .category-chip {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(61,32,16,0.75);
            color: #fff;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            backdrop-filter: blur(4px);
        }

        .card-body {
            padding: 18px 20px 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .card-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            color: #3D2010;
            margin-bottom: 6px;
            line-height: 1.3;
        }

        .card-desc {
            color: #8B6B52;
            font-size: 0.82rem;
            line-height: 1.55;
            flex: 1;
            margin-bottom: 14px;
        }

        .card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .price {
            font-size: 1.15rem;
            font-weight: 700;
            color: #8B5E3C;
        }

        .price span {
            font-size: 0.75rem;
            font-weight: 500;
            opacity: 0.7;
            margin-right: 2px;
        }

        .btn-cart {
            background: linear-gradient(135deg, #8B5E3C, #B87346);
            color: #fff;
            border: none;
            padding: 8px 18px;
            border-radius: 8px;
            font-size: 0.83rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: transform 0.15s, box-shadow 0.15s;
            box-shadow: 0 3px 10px rgba(139,94,60,0.3);
        }
        .btn-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(139,94,60,0.4);
        }

        /* ── EMPTY STATE ── */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #8B5E3C;
        }
        .empty-state .emoji { font-size: 4rem; display: block; margin-bottom: 16px; }
        .empty-state h2 { font-family: 'Playfair Display', serif; font-size: 1.6rem; margin-bottom: 8px; color: #3D2010; }
        .empty-state p { font-size: 0.9rem; opacity: 0.8; }

        /* ── BACK BUTTON ── */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.7);
            border: 1.5px solid rgba(139,94,60,0.25);
            color: #5C3D1E;
            padding: 8px 18px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }
        .btn-back:hover {
            background: rgba(255,255,255,0.95);
            box-shadow: 0 3px 10px rgba(139,94,60,0.15);
        }

        @media (max-width: 600px) {
            .navbar { padding: 0 20px; }
            .info-bar, .filter-bar, .menu-section { padding-left: 16px; padding-right: 16px; }
            .hero { padding: 36px 20px; }
            .hero h1 { font-size: 1.8rem; }
            .menu-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="nav-brand">🍽️ <span>Dine</span>Easy</div>
        <div class="nav-right">
            <span class="nav-user">Hello, {{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" id="btn-logout" class="btn-logout">Logout</button>
            </form>
        </div>
    </nav>

    <!-- HERO -->
    <div class="hero">
        <h1>Our Menu</h1>
        <p>Explore our delicious offerings and pick your favourites</p>
    </div>

    <!-- INFO BADGES -->
    <div class="info-bar">
        <div class="badge">
            <span class="badge-icon">👥</span>
            <span>{{ $pax }} {{ $pax == 1 ? 'Person' : 'People' }}</span>
        </div>
        <div class="badge">
            <span class="badge-icon">💰</span>
            <span>Budget: RM {{ number_format($budget, 2) }}</span>
        </div>
        <div class="badge badge-alt">
            <span class="badge-icon">📋</span>
            <span>{{ $menus->count() }} Items Available</span>
        </div>
        <a href="{{ route('menu.pax') }}" class="badge badge-alt" style="text-decoration:none;">
            <span>✏️ Change Details</span>
        </a>
    </div>

    <!-- FILTER BAR -->
    @php
        $categories = $menus->pluck('category')->unique()->filter()->values();
    @endphp
    @if($categories->count() > 0)
    <div class="filter-bar">
        <button class="filter-btn active" onclick="filterMenu('all', this)" id="filter-all">All</button>
        @foreach($categories as $cat)
            <button class="filter-btn" onclick="filterMenu('{{ Str::slug($cat) }}', this)" id="filter-{{ Str::slug($cat) }}">{{ $cat }}</button>
        @endforeach
    </div>
    @endif

    <!-- MENU GRID -->
    <div class="menu-section">
        @if($menus->isEmpty())
            <div class="empty-state">
                <span class="emoji">🍽️</span>
                <h2>No menu items yet</h2>
                <p>Check back soon — delicious items are on the way!</p>
            </div>
        @else
            <div class="menu-grid" id="menu-grid">
                @foreach($menus as $index => $menu)
                <div class="card" data-category="{{ Str::slug($menu->category) }}" style="animation-delay: {{ $index * 0.05 }}s;">
                    <div class="card-img-wrap">
                        @if($menu->image)
                            <img src="{{ asset('images/' . $menu->image) }}" alt="{{ $menu->name }}">
                        @else
                            <div class="card-img-placeholder">🍜</div>
                        @endif
                        @if($menu->category)
                            <span class="category-chip">{{ $menu->category }}</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <h2 class="card-name">{{ $menu->name }}</h2>
                        @if($menu->description)
                            <p class="card-desc">{{ $menu->description }}</p>
                        @else
                            <p class="card-desc" style="opacity:0.4;font-style:italic;">No description available.</p>
                        @endif
                        <div class="card-footer">
                            <div class="price"><span>RM</span>{{ number_format($menu->price, 2) }}</div>
                            <button class="btn-cart" onclick="alert('Added to cart!')">Add to Cart</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>

    <script>
        function filterMenu(cat, btn) {
            // Update active button
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            // Filter cards
            document.querySelectorAll('#menu-grid .card').forEach(card => {
                if (cat === 'all' || card.dataset.category === cat) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
