<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CrustyBytes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        *{
            font-family: 'Poppins';
        }
        body {
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(120deg, #232526 0%, #414345 100%);
            font-family: 'Inter', Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(44,62,80,0.18);
            padding: 40px 32px 32px 32px;
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }
        .login-header {
            text-align: center;
            margin-bottom: 28px;
        }
        .login-header h2 {
            color: #232526;
            font-size: 2.4rem;
            font-weight: 700;
            margin: 0 0 6px 0;
            letter-spacing: 1px;
        }
        .login-header span {
            color: #ff6600;
            font-size: 1.1rem;
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 22px;
            margin-right: 2rem;
        }
        label {
            display: block;
            margin-bottom: 7px;
            color: #232526;
            font-size: 1rem;
            font-weight: 600;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 13px 14px;
            border: 1.5px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1.05rem;
            background: #f7f7f7;
            color: #232526;
            transition: border 0.2s;
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #ff6600;
            outline: none;
        }
        .checkbox-row {
            display: flex;
            align-items: center;
            margin-bottom: 22px;
        }
        .checkbox-row input[type="checkbox"] {
            accent-color: #ff6600;
            margin-right: 8px;
        }
        .checkbox-row label {
            color: #555;
            font-size: 0.98rem;
            font-weight: 500;
            margin: 0;
        }
        .login-btn {
            background: #ff6600;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 13px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.18s;
            margin-top: 8px;
        }
        .login-btn:hover {
            background: #e65c00;
        }
        .alert {
            text-align: center;
            padding: 10px 0;
            border-radius: 6px;
            margin-bottom: 18px;
            font-size: 1rem;
        }
        .alert-error {
            background: #ffeaea;
            color: #d32f2f;
        }
        .alert-success {
            background: #eaffea;
            color: #388e3c;
        }
        @media (max-width: 500px) {
            .login-card {
                padding: 24px 8vw 24px 8vw;
                max-width: 98vw;
            }
            .login-header h2 {
                font-size: 1.4rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <h2>Welcome Back</h2>
            <span>Sign in to CrustyBytes</span>
        </div>
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ route('login.admin') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
            </div>
            <div class="checkbox-row">
                <input type="checkbox" id="show-password" onclick="togglePassword()">
                <label for="show-password">Show Password</label>
            </div>
            <button type="submit" class="login-btn">Log in</button>
        </form>
    </div>
    <script>
        function togglePassword() {
            const pwd = document.getElementById('password');
            pwd.type = pwd.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>