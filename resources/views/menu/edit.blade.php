<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu Item – Admin</title>
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
            position: fixed; top: 0; left: 0;
            width: 240px; height: 100vh;
            background: linear-gradient(180deg, #2C1504 0%, #1A0F08 100%);
            border-right: 1px solid rgba(184,115,70,0.15);
            display: flex; flex-direction: column; padding: 0 0 24px;
            z-index: 100;
        }
        .sidebar-brand { padding: 28px 24px 24px; border-bottom: 1px solid rgba(184,115,70,0.12); margin-bottom: 16px; }
        .sidebar-brand h2 { font-family: 'Playfair Display', serif; font-size: 1.25rem; color: #E8A96A; }
        .sidebar-brand p { font-size: 0.75rem; color: rgba(232,213,196,0.45); margin-top: 4px; }
        .sidebar-avatar { width: 38px; height: 38px; border-radius: 50%; background: linear-gradient(135deg, #8B5E3C, #B87346); display: flex; align-items: center; justify-content: center; font-size: 1rem; margin-bottom: 10px; box-shadow: 0 4px 12px rgba(139,94,60,0.4); }
        .sidebar-nav { flex: 1; padding: 0 12px; }
        .nav-item { display: flex; align-items: center; gap: 10px; padding: 11px 14px; border-radius: 10px; color: rgba(232,213,196,0.65); font-size: 0.88rem; font-weight: 500; cursor: pointer; transition: all 0.2s; text-decoration: none; margin-bottom: 4px; }
        .nav-item:hover { background: rgba(184,115,70,0.12); color: #E8D5C4; }
        .nav-item.active { background: linear-gradient(135deg, rgba(139,94,60,0.3), rgba(184,115,70,0.2)); color: #E8A96A; border: 1px solid rgba(184,115,70,0.2); }
        .sidebar-footer { padding: 0 12px; }
        .btn-logout-side { display: flex; align-items: center; gap: 10px; width: 100%; padding: 11px 14px; background: rgba(220,80,60,0.08); border: 1px solid rgba(220,80,60,0.15); color: rgba(240,130,110,0.8); border-radius: 10px; font-size: 0.88rem; font-weight: 500; font-family: 'Inter', sans-serif; cursor: pointer; transition: all 0.2s; }
        .btn-logout-side:hover { background: rgba(220,80,60,0.15); color: #F08070; border-color: rgba(220,80,60,0.3); }

        /* ── MAIN ── */
        .main { margin-left: 240px; padding: 40px 40px 60px; }

        .back-link {
            display: inline-flex; align-items: center; gap: 6px;
            color: rgba(232,213,196,0.5); font-size: 0.85rem;
            text-decoration: none; margin-bottom: 24px;
            transition: color 0.2s;
        }
        .back-link:hover { color: #E8A96A; }

        .page-title { font-family: 'Playfair Display', serif; font-size: 2rem; color: #F5E9DC; margin-bottom: 4px; }
        .page-subtitle { color: rgba(232,213,196,0.45); font-size: 0.88rem; margin-bottom: 36px; }

        /* ── LAYOUT ── */
        .edit-layout {
            display: grid;
            grid-template-columns: 1fr 280px;
            gap: 24px;
            max-width: 960px;
            align-items: start;
        }

        /* ── FORM CARD ── */
        .form-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(184,115,70,0.12);
            border-radius: 18px;
            padding: 36px;
        }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .form-group { display: flex; flex-direction: column; }
        .form-group.full { grid-column: 1 / -1; }

        label {
            font-size: 0.78rem; font-weight: 600;
            color: rgba(232,213,196,0.55); text-transform: uppercase;
            letter-spacing: 0.07em; margin-bottom: 8px;
        }

        input[type="text"], input[type="number"], textarea, select {
            width: 100%; padding: 12px 16px;
            background: rgba(255,255,255,0.05);
            border: 1.5px solid rgba(184,115,70,0.18);
            border-radius: 10px; color: #E8D5C4;
            font-size: 0.92rem; font-family: 'Inter', sans-serif;
            outline: none; transition: border-color 0.2s, background 0.2s;
        }
        input[type="text"]:focus, input[type="number"]:focus, textarea:focus, select:focus {
            border-color: #B87346; background: rgba(255,255,255,0.08);
        }
        input[type="number"] { -moz-appearance: textfield; }
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button { -webkit-appearance: none; }
        select option { background: #2C1504; color: #E8D5C4; }
        textarea { resize: vertical; min-height: 100px; line-height: 1.6; }

        .error-msg { color: #FCA5A5; font-size: 0.78rem; margin-top: 5px; }
        .section-divider { height: 1px; background: rgba(184,115,70,0.1); margin: 24px 0; }

        /* ── SIDE PANEL (current image) ── */
        .side-panel {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(184,115,70,0.12);
            border-radius: 18px;
            padding: 24px;
            position: sticky;
            top: 40px;
        }
        .side-panel h3 {
            font-size: 0.8rem; font-weight: 600;
            color: rgba(232,213,196,0.45); text-transform: uppercase;
            letter-spacing: 0.07em; margin-bottom: 14px;
        }
        .current-img {
            width: 100%; border-radius: 12px;
            overflow: hidden; background: rgba(184,115,70,0.1);
            margin-bottom: 16px; aspect-ratio: 4/3;
            display: flex; align-items: center; justify-content: center;
        }
        .current-img img { width: 100%; height: 100%; object-fit: cover; }
        .no-img-placeholder { font-size: 3rem; }

        .change-img-label {
            font-size: 0.8rem; font-weight: 600;
            color: rgba(232,213,196,0.45); text-transform: uppercase;
            letter-spacing: 0.07em; margin-bottom: 8px; display: block;
        }

        .upload-area {
            border: 2px dashed rgba(184,115,70,0.25);
            border-radius: 10px; padding: 18px;
            text-align: center; cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
            position: relative;
        }
        .upload-area:hover { border-color: #B87346; background: rgba(184,115,70,0.05); }
        .upload-area input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
        .upload-text { color: rgba(232,213,196,0.5); font-size: 0.8rem; margin-top: 6px; }
        .upload-text strong { color: #E8A96A; }
        #image-preview { margin-top: 10px; width: 100%; border-radius: 8px; display: none; border: 1.5px solid rgba(184,115,70,0.2); }

        /* ── BUTTONS ── */
        .form-actions { display: flex; gap: 12px; margin-top: 28px; flex-wrap: wrap; }

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

        @media (max-width: 900px) {
            .edit-layout { grid-template-columns: 1fr; }
            .side-panel { position: static; }
        }
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
            <div class="sidebar-avatar">👨‍🍳</div>
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
        </nav>
        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" id="btn-logout-edit" class="btn-logout-side">
                    <span>🚪</span> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main">
        <a href="{{ route('menu.manage') }}" class="back-link">← Back to Menu Management</a>

        <h1 class="page-title">Edit Menu Item</h1>
        <p class="page-subtitle">Update the details for <strong style="color:#E8A96A;">{{ $menu->name }}</strong></p>

        <form method="POST" action="{{ route('menu.update', $menu) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="edit-layout">
                <!-- Form Fields -->
                <div class="form-card">
                    <div class="form-grid">
                        <!-- Name -->
                        <div class="form-group full">
                            <label for="name">Item Name *</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $menu->name) }}" placeholder="e.g. Nasi Lemak Special" required>
                            @error('name') <p class="error-msg">{{ $message }}</p> @enderror
                        </div>

                        <!-- Price -->
                        <div class="form-group">
                            <label for="price">Price (RM) *</label>
                            <input type="number" id="price" name="price" value="{{ old('price', $menu->price) }}" placeholder="0.00" min="0" step="0.01" required>
                            @error('price') <p class="error-msg">{{ $message }}</p> @enderror
                        </div>

                        <!-- Category -->
                        <div class="form-group">
                            <label for="category">Category *</label>
                            <select id="category" name="category" required>
                                <option value="" disabled>— Select a category —</option>
                                @foreach(['Appetizer', 'Main Course', 'Side Dish', 'Dessert', 'Beverage'] as $cat)
                                    <option value="{{ $cat }}" {{ old('category', $menu->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                            @error('category') <p class="error-msg">{{ $message }}</p> @enderror
                        </div>

                        <!-- Description -->
                        <div class="form-group full">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" placeholder="Describe the dish…">{{ old('description', $menu->description) }}</textarea>
                            @error('description') <p class="error-msg">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" id="btn-update-item" class="btn-submit">
                            <span>✅</span> Update Item
                        </button>
                        <a href="{{ route('menu.manage') }}" class="btn-cancel">Cancel</a>
                    </div>
                </div>

                <!-- Side Panel: Image -->
                <div class="side-panel">
                    <h3>Current Image</h3>
                    <div class="current-img" id="current-img-wrap">
                        @if($menu->image)
                            <img src="{{ asset('images/' . $menu->image) }}" alt="{{ $menu->name }}" id="existing-img">
                        @else
                            <span class="no-img-placeholder">🍜</span>
                        @endif
                    </div>

                    <span class="change-img-label">Replace Image</span>
                    <div class="upload-area">
                        <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                        <div style="font-size:1.5rem;margin-bottom:6px;">🖼️</div>
                        <p class="upload-text"><strong>Click to replace</strong></p>
                        <p class="upload-text" style="font-size:0.75rem;margin-top:3px;">PNG, JPG, GIF up to 2MB</p>
                        <img id="image-preview" src="" alt="New Preview">
                    </div>
                    @error('image') <p class="error-msg" style="margin-top:8px;">{{ $message }}</p> @enderror
                </div>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const preview = document.getElementById('image-preview');
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';

                // Hide the existing image in favour of the preview
                const existing = document.getElementById('existing-img');
                if (existing) existing.style.display = 'none';
                document.querySelector('.no-img-placeholder') && (document.querySelector('.no-img-placeholder').style.display = 'none');
            }
        }
    </script>
</body>
</html>
