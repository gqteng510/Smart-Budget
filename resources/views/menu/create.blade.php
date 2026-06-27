<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu Item – Admin</title>
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

        /* ── MAIN ── */
        .main { margin-left: 240px; padding: 40px 40px 60px; }

        .back-link {
            display: inline-flex; align-items: center; gap: 6px;
            color: rgba(232,213,196,0.5); font-size: 0.85rem;
            text-decoration: none; margin-bottom: 24px;
            transition: color 0.2s;
        }
        .back-link:hover { color: #E8A96A; }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem; color: #F5E9DC; margin-bottom: 4px;
        }
        .page-subtitle { color: rgba(232,213,196,0.45); font-size: 0.88rem; margin-bottom: 36px; }

        /* ── FORM CARD ── */
        .form-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(184,115,70,0.12);
            border-radius: 18px;
            padding: 40px;
            max-width: 680px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .form-group { display: flex; flex-direction: column; }
        .form-group.full { grid-column: 1 / -1; }

        label {
            font-size: 0.78rem;
            font-weight: 600;
            color: rgba(232,213,196,0.55);
            text-transform: uppercase;
            letter-spacing: 0.07em;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 12px 16px;
            background: rgba(255,255,255,0.05);
            border: 1.5px solid rgba(184,115,70,0.18);
            border-radius: 10px;
            color: #E8D5C4;
            font-size: 0.92rem;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: border-color 0.2s, background 0.2s;
        }
        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus,
        select:focus {
            border-color: #B87346;
            background: rgba(255,255,255,0.08);
        }
        input[type="number"] { -moz-appearance: textfield; }
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button { -webkit-appearance: none; }

        select option { background: #2C1504; color: #E8D5C4; }

        textarea { resize: vertical; min-height: 100px; line-height: 1.6; }

        .error-msg { color: #FCA5A5; font-size: 0.78rem; margin-top: 5px; }

        /* ── IMAGE UPLOAD ── */
        .upload-area {
            border: 2px dashed rgba(184,115,70,0.25);
            border-radius: 12px;
            padding: 28px;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
            position: relative;
        }
        .upload-area:hover { border-color: #B87346; background: rgba(184,115,70,0.05); }
        .upload-area input[type="file"] {
            position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
        }
        .upload-icon { font-size: 2rem; margin-bottom: 8px; }
        .upload-text { color: rgba(232,213,196,0.55); font-size: 0.85rem; }
        .upload-text strong { color: #E8A96A; }
        #image-preview {
            margin-top: 14px;
            max-width: 200px;
            border-radius: 10px;
            display: none;
            border: 2px solid rgba(184,115,70,0.2);
        }

        /* ── DIVIDER ── */
        .section-divider {
            height: 1px;
            background: rgba(184,115,70,0.1);
            margin: 28px 0;
        }

        /* ── BUTTONS ── */
        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 28px;
            flex-wrap: wrap;
        }

        .btn-submit {
            display: inline-flex; align-items: center; gap: 8px;
            background: linear-gradient(135deg, #8B5E3C, #B87346);
            color: #fff; border: none; padding: 13px 32px;
            border-radius: 10px; font-size: 0.92rem; font-weight: 600;
            font-family: 'Inter', sans-serif; cursor: pointer;
            box-shadow: 0 6px 18px rgba(139,94,60,0.4);
            transition: transform 0.15s, box-shadow 0.15s;
        }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 10px 24px rgba(139,94,60,0.5); }

        .btn-cancel {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);
            color: rgba(232,213,196,0.6); padding: 13px 24px;
            border-radius: 10px; font-size: 0.92rem; font-weight: 500;
            font-family: 'Inter', sans-serif; cursor: pointer;
            text-decoration: none; transition: background 0.2s;
        }
        .btn-cancel:hover { background: rgba(255,255,255,0.1); color: #E8D5C4; }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main { margin-left: 0; padding: 24px 16px; }
            .form-grid { grid-template-columns: 1fr; }
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
            <a href="{{ route('menu.create') }}" class="nav-item active">
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
                <button type="submit" id="btn-logout-create" class="btn-logout-side">
                    <span>🚪</span> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main">
        <a href="{{ route('menu.manage') }}" class="back-link">← Back to Menu Management</a>

        <h1 class="page-title">Add New Item</h1>
        <p class="page-subtitle">Fill in the details below to add a new item to your menu.</p>

        <div class="form-card">
            <form method="POST" action="{{ route('menu.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-grid">
                    <!-- Name -->
                    <div class="form-group full">
                        <label for="name">Item Name *</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. Nasi Lemak Special" required>
                        @error('name') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>

                    <!-- Price -->
                    <div class="form-group">
                        <label for="price">Price (RM) *</label>
                        <input type="number" id="price" name="price" value="{{ old('price') }}" placeholder="0.00" min="0" step="0.01" required>
                        @error('price') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>

                    <!-- Category -->
                    <div class="form-group">
                        <label for="category">Category *</label>
                        <select id="category" name="category" required>
                            <option value="" disabled {{ old('category') ? '' : 'selected' }}>— Select a category —</option>
                            @foreach(['Appetizer', 'Main Course', 'Side Dish', 'Dessert', 'Beverage'] as $cat)
                                <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                        @error('category') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-group full">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" placeholder="Describe the dish — ingredients, preparation style, etc.">{{ old('description') }}</textarea>
                        @error('description') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- Image Upload -->
                <div class="form-group">
                    <label>Food Image (optional)</label>
                    <div class="upload-area" id="upload-area">
                        <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                        <div class="upload-icon">🖼️</div>
                        <p class="upload-text"><strong>Click to upload</strong> or drag & drop</p>
                        <p class="upload-text" style="margin-top:4px;font-size:0.78rem;">PNG, JPG, GIF up to 2MB</p>
                        <img id="image-preview" src="" alt="Preview">
                    </div>
                    @error('image') <p class="error-msg">{{ $message }}</p> @enderror
                </div>

                <!-- Actions -->
                <div class="form-actions">
                    <button type="submit" id="btn-save-item" class="btn-submit">
                        <span>💾</span> Save Item
                    </button>
                    <a href="{{ route('menu.manage') }}" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const preview = document.getElementById('image-preview');
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
                document.getElementById('upload-area').querySelector('.upload-icon').style.display = 'none';
            }
        }
    </script>
</body>
</html>
