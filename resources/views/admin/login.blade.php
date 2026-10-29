<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | SD International</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: #0f172a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-card {
            background: #ffffff;
            width: 100%;
            max-width: 420px;
            border-radius: 12px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }
        .login-header {
            background: #64141f;
            padding: 30px;
            text-align: center;
            color: white;
        }
        .login-header img {
            max-height: 40px;
            margin-bottom: 12px;
            filter: brightness(0) invert(1);
        }
        .login-header h2 {
            font-size: 20px;
            font-weight: 700;
        }
        .login-header p {
            font-size: 13px;
            color: #fca5a5;
            margin-top: 4px;
        }
        .login-body {
            padding: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-size: 13.5px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }
        .form-control {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 14px;
        }
        .form-control:focus {
            outline: none;
            border-color: #64141f;
            box-shadow: 0 0 0 3px rgba(100,20,31,0.15);
        }
        .btn-login {
            width: 100%;
            background: #64141f;
            color: white;
            border: none;
            padding: 12px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-login:hover {
            background: #4e0f18;
        }
        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            padding: 10px 14px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <img src="{{ asset('uploads/2020/07/logo.png') }}" alt="SD International">
            <h2>Admin Control Center</h2>
            <p>Sign in to manage catalog, SEO & leads</p>
        </div>

        <div class="login-body">
            @if($errors->any())
                <div class="alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Admin Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email', 'admin@sdinternational.com') }}" class="form-control" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value="admin123456" class="form-control" required>
                </div>

                <div style="margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                    <input type="checkbox" name="remember" id="remember" checked>
                    <label for="remember" style="font-size: 13px; color: #64748b; cursor: pointer;">Remember this session</label>
                </div>

                <button type="submit" class="btn-login">Sign In to Dashboard</button>
            </form>
        </div>
    </div>
</body>
</html>
