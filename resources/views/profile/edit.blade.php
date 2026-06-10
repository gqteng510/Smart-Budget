<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile – Ezzati Catering</title>
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
            width: 64px;
            height: 64px;
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
            max-width: 900px;
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
            animation: fadeIn 0.3s ease-out;
        }
        .alert.error {
            background: rgba(220,80,60,0.08);
            border: 1px solid rgba(220,80,60,0.15);
            color: #c62828;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ── USER INFO CARD ── */
        .user-header-card {
            background: linear-gradient(135deg, #6B3E1E, #8B5E3C);
            border-radius: 16px;
            padding: 28px 32px;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 24px;
            box-shadow: 0 6px 20px rgba(139,94,60,0.2);
            margin-top: 24px;
        }

        .user-avatar-large {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 700;
            border: 2.5px solid rgba(255,255,255,0.35);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .user-avatar-img-large {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 2.5px solid rgba(255,255,255,0.35);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .user-details h2 {
            font-size: 1.4rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .user-details p {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.8);
            margin-top: 2px;
        }

        .user-details span {
            font-size: 0.78rem;
            color: rgba(255,255,255,0.6);
            display: block;
            margin-top: 4px;
        }

        /* ── CARD SECTIONS ── */
        .details-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 32px;
            margin-top: 28px;
            border: 1px solid rgba(139,94,60,0.15);
            box-shadow: 0 4px 12px rgba(139,94,60,0.04);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(139,94,60,0.08);
            padding-bottom: 16px;
            margin-bottom: 24px;
        }

        .card-header h3 {
            font-size: 1.15rem;
            font-weight: 700;
            color: #3D2010;
        }

        .card-header .edit-link {
            font-size: 0.88rem;
            color: #8B5E3C;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 4px;
            cursor: pointer;
        }

        .card-header .edit-link:hover {
            color: #6B3E1E;
        }

        /* ── FORM FIELDS ── */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 0.72rem;
            color: #8B6B52;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 700;
            display: block;
            margin-bottom: 6px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            height: 48px;
            background: #FDF9F5;
            border: 1.5px solid rgba(139,94,60,0.2);
            color: #3D2010;
            padding: 0 16px;
            border-radius: 8px;
            font-size: 0.92rem;
            font-family: inherit;
            transition: border-color 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #8B5E3C;
            background: #ffffff;
        }

        .form-group input:disabled {
            background: #F5F0EA;
            border-color: rgba(139,94,60,0.1);
            color: #8B8076;
            cursor: not-allowed;
        }

        .error-text {
            color: #c62828;
            font-size: 12px;
            margin-top: 6px;
            display: block;
        }

        /* ── BUTTONS ── */
        .btn-save {
            background: linear-gradient(135deg, #8B5E3C, #B87346);
            color: #ffffff;
            border: none;
            padding: 12px 28px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(139,94,60,0.25);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-save:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(139,94,60,0.35);
        }

        .btn-danger {
            background: #c62828;
            color: #ffffff;
            border: none;
            padding: 12px 28px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(198,40,40,0.2);
        }

        .btn-danger:hover {
            background: #b71c1c;
            transform: translateY(-1px);
        }

        /* ── MODAL ── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(4px);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s ease;
        }

        .modal-overlay.open {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-content {
            background: #ffffff;
            width: 480px;
            border-radius: 16px;
            padding: 32px;
            border: 1px solid rgba(139,94,60,0.15);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            transform: translateY(20px);
            transition: transform 0.25s ease;
        }

        .modal-overlay.open .modal-content {
            transform: translateY(0);
        }

        .modal-content h3 {
            font-size: 1.2rem;
            font-weight: 700;
            color: #3D2010;
            margin-bottom: 8px;
        }

        .modal-content p {
            font-size: 0.88rem;
            color: #8B6B52;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
        }

        .btn-secondary {
            background: #F5F0EA;
            color: #5C3D1E;
            border: 1px solid rgba(139,94,60,0.2);
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-secondary:hover {
            background: #EDD5BE;
        }

        /* ── RESPONSIVE DESIGN ── */
        @media (max-width: 768px) {
            body { flex-direction: column; }
            .sidebar { width: 100%; height: auto; position: relative; border-right: none; border-bottom: 1px solid rgba(139,94,60,0.15); }
            .main { margin-left: 0; }
            .top-bar { padding: 0 24px; }
            .main-content { padding: 24px; }
            .user-header-card { flex-direction: column; text-align: center; gap: 16px; }
        }
    </style>
</head>
<body>

    @php
        $userName = $user->name;
        $userEmail = $user->email;
        $initial = strtoupper(substr($userName, 0, 1));
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
            @if($user->avatar)
                <img src="{{ asset('images/' . $user->avatar) }}" class="user-avatar" style="object-fit:cover;" alt="Avatar">
            @else
                <div class="user-avatar">{{ $initial }}</div>
            @endif
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
            <a href="{{ route('orders.index') }}" class="nav-item">
                <span style="font-size: 1.1rem;">📋</span> My Orders
            </a>
            <a href="{{ route('profile.edit') }}" class="nav-item active">
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
            <h2>Profile</h2>
        </div>

        <!-- MAIN CONTENT -->
        <div class="main-content">
            <!-- STATUS ALERTS -->
            @if(session('status') === 'profile-updated')
                <div class="alert">
                    <span>✅</span> Profile details updated successfully!
                </div>
            @endif
            @if(session('status') === 'password-updated')
                <div class="alert">
                    <span>✅</span> Password updated successfully!
                </div>
            @endif
            @if($errors->updatePassword->any())
                <div class="alert error">
                    <span>❌</span> Error updating password. Please check your inputs.
                </div>
            @endif
            @if($errors->userDeletion->any())
                <div class="alert error">
                    <span>❌</span> Account deletion failed. Please check your password.
                </div>
            @endif

            <h1 class="page-title">My Profile</h1>
            <p class="page-subtitle">View and manage your account information</p>

            <!-- USER HEADER CARD -->
            <div class="user-header-card">
                @if($user->avatar)
                    <img src="{{ asset('images/' . $user->avatar) }}" class="user-avatar-img-large" alt="Avatar">
                @else
                    <div class="user-avatar-large">{{ $initial }}</div>
                @endif
                <div class="user-details">
                    <h2>{{ $userName }}</h2>
                    <p>{{ $userEmail }}</p>
                    <span>Member since {{ $user->created_at->format('F Y') }}</span>
                </div>
            </div>

            <!-- ACCOUNT DETAILS CARD -->
            <div class="details-card">
                <div class="card-header">
                    <h3>Account Details</h3>
                    <span class="edit-link" onclick="focusFirstField()">✏️ Edit</span>
                </div>

                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <div class="form-group">
                        <label>✉ Email Address</label>
                        <input type="email" value="{{ $userEmail }}" disabled>
                        <span class="error-text" style="color:#8B6B52; font-style:italic;">Email address cannot be changed</span>
                    </div>

                    <div class="form-group">
                        <label>👤 Full Name</label>
                        <input type="text" name="name" id="name-field" value="{{ old('name', $userName) }}" required>
                        @error('name')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>📞 Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" required>
                        @error('phone')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>📍 Default Address</label>
                        <input type="text" name="address" value="{{ old('address', $user->address) }}" required>
                        @error('address')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>🖼️ Change Profile Picture</label>
                        <input type="file" name="avatar" accept="image/*" style="padding: 10px 0;">
                        @error('avatar')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div style="margin-top: 24px;">
                        <button type="submit" class="btn-save" id="btn-save-profile">Save Changes</button>
                    </div>
                </form>
            </div>

            <!-- SECURITY / PASSWORD CARD -->
            <div class="details-card">
                <div class="card-header">
                    <h3>Update Password</h3>
                </div>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label>🔑 Current Password</label>
                        <input type="password" name="current_password" autocomplete="current-password" required>
                        @if($errors->updatePassword->has('current_password'))
                            <span class="error-text">{{ $errors->updatePassword->first('current_password') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>🔒 New Password</label>
                        <input type="password" name="password" autocomplete="new-password" required>
                        @if($errors->updatePassword->has('password'))
                            <span class="error-text">{{ $errors->updatePassword->first('password') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>🔒 Confirm New Password</label>
                        <input type="password" name="password_confirmation" autocomplete="new-password" required>
                    </div>

                    <div style="margin-top: 24px;">
                        <button type="submit" class="btn-save" id="btn-save-password">Update Password</button>
                    </div>
                </form>
            </div>

            <!-- DANGER ZONE CARD -->
            <div class="details-card" style="border-color: rgba(198,40,40,0.3); background: #FFF5F5;">
                <div class="card-header" style="border-bottom-color: rgba(198,40,40,0.15);">
                    <h3 style="color: #c62828;">Danger Zone</h3>
                </div>

                <p style="font-size: 0.88rem; color: #8B6B52; line-height: 1.5; margin-bottom: 20px;">
                    Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
                </p>

                <button class="btn-danger" id="btn-open-delete-modal" onclick="toggleDeleteModal(true)">Delete Account</button>
            </div>
        </div>
    </main>

    <!-- DELETE CONFIRMATION MODAL -->
    <div class="modal-overlay" id="delete-modal-overlay">
        <div class="modal-content">
            <h3>Are you sure you want to delete your account?</h3>
            <p>Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.</p>

            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="form-group" style="margin-bottom: 0;">
                    <label>🔑 Enter Password</label>
                    <input type="password" name="password" placeholder="Your Password" required>
                    @if($errors->userDeletion->has('password'))
                        <span class="error-text">{{ $errors->userDeletion->first('password') }}</span>
                    @endif
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-secondary" onclick="toggleDeleteModal(false)">Cancel</button>
                    <button type="submit" class="btn-danger" id="btn-confirm-delete">Delete Account</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Auto-open modal if validation errors exist on deletion
        document.addEventListener('DOMContentLoaded', () => {
            const hasDeletionErrors = {{ $errors->userDeletion->isNotEmpty() ? 'true' : 'false' }};
            if (hasDeletionErrors) {
                toggleDeleteModal(true);
            }
        });

        function focusFirstField() {
            document.getElementById('name-field').focus();
        }

        function toggleDeleteModal(isOpen) {
            const overlay = document.getElementById('delete-modal-overlay');
            if (isOpen) {
                overlay.classList.add('open');
            } else {
                overlay.classList.remove('open');
            }
        }
    </script>
</body>
</html>
