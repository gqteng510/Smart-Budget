<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome – Dining Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #F5E9DC 0%, #EDD5BE 50%, #E4C5A8 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Decorative circles */
        body::before {
            content: '';
            position: fixed;
            top: -120px; left: -120px;
            width: 400px; height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(139,94,60,0.15) 0%, transparent 70%);
            pointer-events: none;
        }
        body::after {
            content: '';
            position: fixed;
            bottom: -100px; right: -100px;
            width: 350px; height: 350px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(139,94,60,0.12) 0%, transparent 70%);
            pointer-events: none;
        }

        .card {
            background: rgba(255,255,255,0.88);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border-radius: 24px;
            padding: 52px 48px;
            width: 100%;
            max-width: 480px;
            box-shadow:
                0 8px 32px rgba(139,94,60,0.15),
                0 2px 8px rgba(0,0,0,0.06),
                inset 0 1px 0 rgba(255,255,255,0.8);
            border: 1px solid rgba(255,255,255,0.6);
            animation: fadeUp 0.5s ease-out;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .icon-wrap {
            width: 72px; height: 72px;
            border-radius: 20px;
            background: linear-gradient(135deg, #8B5E3C, #B87346);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 24px;
            box-shadow: 0 8px 20px rgba(139,94,60,0.35);
            font-size: 32px;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: #3D2010;
            text-align: center;
            margin-bottom: 8px;
            line-height: 1.2;
        }

        .subtitle {
            text-align: center;
            color: #8B5E3C;
            font-size: 0.92rem;
            margin-bottom: 36px;
            font-weight: 400;
            letter-spacing: 0.01em;
        }

        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(139,94,60,0.2), transparent);
            margin-bottom: 32px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: #5C3D1E;
            margin-bottom: 8px;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            color: #8B5E3C;
            font-size: 1.1rem;
            pointer-events: none;
            user-select: none;
        }

        input[type="number"] {
            width: 100%;
            padding: 14px 16px 14px 44px;
            border: 2px solid rgba(139,94,60,0.2);
            border-radius: 12px;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            color: #3D2010;
            background: rgba(255,255,255,0.7);
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            outline: none;
            -moz-appearance: textfield;
        }
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }

        input[type="number"]:focus {
            border-color: #8B5E3C;
            box-shadow: 0 0 0 4px rgba(139,94,60,0.12);
            background: #fff;
        }

        .error-msg {
            color: #c0392b;
            font-size: 0.8rem;
            margin-top: 6px;
        }

        .hint {
            color: #A07850;
            font-size: 0.78rem;
            margin-top: 5px;
        }

        .btn-submit {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #8B5E3C, #B87346);
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            margin-top: 8px;
            letter-spacing: 0.03em;
            box-shadow: 0 6px 18px rgba(139,94,60,0.4);
            transition: transform 0.15s, box-shadow 0.15s, background 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(139,94,60,0.45);
            background: linear-gradient(135deg, #7A5234, #A66538);
        }
        .btn-submit:active {
            transform: translateY(0);
            box-shadow: 0 4px 12px rgba(139,94,60,0.3);
        }

        .logout-link {
            display: block;
            text-align: center;
            margin-top: 24px;
            font-size: 0.83rem;
            color: #8B5E3C;
            text-decoration: none;
            opacity: 0.7;
            transition: opacity 0.2s;
        }
        .logout-link:hover { opacity: 1; }

        .user-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(139,94,60,0.1);
            color: #6B4226;
            font-size: 0.8rem;
            font-weight: 500;
            padding: 4px 12px;
            border-radius: 20px;
            margin: 0 auto 20px;
            text-align: center;
            width: fit-content;
            display: flex;
        }
        .user-badge-wrap {
            display: flex;
            justify-content: center;
            margin-bottom: 16px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon-wrap" style="background:#fff; display:flex; align-items:center; justify-content:center; overflow:hidden; padding:12px;">
            <img src="{{ asset('images/logo.png') }}" style="width:100%; height:100%; object-fit:contain;" alt="Logo">
        </div>

        <h1>Plan Your Dining</h1>
        <p class="subtitle">Tell us a little about your visit so we can help you order smarter.</p>

        <div class="user-badge-wrap">
            <span class="user-badge">
                👤 {{ auth()->user()->name }}
            </span>
        </div>

        <div class="divider"></div>

        @if($errors->any())
            <div style="background:#FFF0ED;border:1px solid #F4C2B0;border-radius:10px;padding:12px 16px;margin-bottom:20px;">
                @foreach($errors->all() as $error)
                    <p class="error-msg" style="margin:0;">⚠️ {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('menu.storePax') }}">
            @csrf

            <div class="form-group">
                <label for="pax">Number of Pax</label>
                <div class="input-wrap">
                    <span class="input-icon">👥</span>
                    <input
                        type="number"
                        id="pax"
                        name="pax"
                        min="1"
                        max="100"
                        value="{{ old('pax', 1) }}"
                        placeholder="e.g. 4"
                        required
                    >
                </div>
                <p class="hint">How many people are dining today?</p>
                @error('pax')
                    <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="budget">Total Budget (RM)</label>
                <div class="input-wrap">
                    <span class="input-icon" style="font-size:0.95rem;font-weight:700;color:#8B5E3C;">RM</span>
                    <input
                        type="number"
                        id="budget"
                        name="budget"
                        min="0"
                        step="0.01"
                        value="{{ old('budget') }}"
                        placeholder="e.g. 150.00"
                        required
                        style="padding-left:52px;"
                    >
                </div>
                <p class="hint">Your total spending limit for this meal.</p>
                @error('budget')
                    <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" id="btn-go-to-menu" class="btn-submit">
                <span>View Menu</span>
                <span>→</span>
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" style="text-align:center;">
            @csrf
            <button type="submit" class="logout-link" style="background:none;border:none;cursor:pointer;font-family:inherit;">
                ← Logout
            </button>
        </form>
    </div>
</body>
</html>
