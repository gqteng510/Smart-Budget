<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 40px 0;
        }

        .container {
            background: white;
            width: 440px;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            max-height: 95vh;
            overflow-y: auto;
        }

        h1 {
            text-align: center;
            font-size: 32px;
            margin-bottom: 5px;
            color: #222;
        }

        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 25px;
            font-size: 14px;
        }

        label {
            font-size: 14px;
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
            color: #222;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-size: 14px;
            box-sizing: border-box;
        }

        input:focus {
            outline: none;
            border-color: #4CAF50;
        }

        .error-text {
            color: #c62828;
            font-size: 12px;
            margin-top: -14px;
            margin-bottom: 14px;
            display: block;
        }

        .register-btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            background: #4CAF50;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 5px;
        }

        .register-btn:hover {
            background: #43a047;
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            background: #e5e7eb;
            color: #333;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 12px;
        }

        .login-btn:hover {
            background: #d1d5db;
        }

    </style>

</head>

<body>

<div class="container">

    <h1>SmartBudget</h1>

    <p class="subtitle">Create your Ezzati Catering account</p>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">

        @csrf

        <label>👤 Name</label>

        <input 
            type="text" 
            name="name"
            placeholder="Enter your name"
            value="{{ old('name') }}"
            required
        >
        @error('name')
            <span class="error-text">{{ $message }}</span>
        @enderror

        <label>📧 Email</label>

        <input 
            type="email"
            name="email"
            placeholder="Enter your email"
            value="{{ old('email') }}"
            required
        >
        @error('email')
            <span class="error-text">{{ $message }}</span>
        @enderror

        <label>📞 Phone Number</label>

        <input 
            type="text"
            name="phone"
            placeholder="Enter your phone number"
            value="{{ old('phone') }}"
            required
        >
        @error('phone')
            <span class="error-text">{{ $message }}</span>
        @enderror

        <label>📍 Default Address</label>

        <input 
            type="text"
            name="address"
            placeholder="Enter your address"
            value="{{ old('address') }}"
            required
        >
        @error('address')
            <span class="error-text">{{ $message }}</span>
        @enderror

        <label>🖼️ Profile Picture</label>

        <input 
            type="file"
            name="avatar"
            accept="image/*"
            style="padding: 8px;"
        >
        @error('avatar')
            <span class="error-text">{{ $message }}</span>
        @enderror

        <label>🔑 Password</label>

        <input 
            type="password"
            name="password"
            placeholder="Enter your password"
            required
        >
        @error('password')
            <span class="error-text">{{ $message }}</span>
        @enderror

        <label>🔒 Confirm Password</label>

        <input 
            type="password"
            name="password_confirmation"
            placeholder="Confirm your password"
            required
        >

        <button type="submit" class="register-btn">
            Register
        </button>

    </form>

    <a href="{{ route('login') }}">

        <button class="login-btn">
            Back to Login
        </button>

    </a>

</div>

</body>
</html>