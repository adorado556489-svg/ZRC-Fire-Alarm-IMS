<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ZRC Fire Alarm - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .25);
        }
        .login-header {
            background: #c0392b;
            color: #fff;
            border-radius: 12px 12px 0 0;
            padding: 20px 24px;
        }
        .login-header h4 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
        }
        .login-header p {
            margin: 4px 0 0;
            font-size: 13px;
            opacity: .9;
        }
        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #444;
        }
        .form-control {
            border-radius: 8px;
            font-size: 14px;
            padding: 10px 12px;
        }
        .btn-login {
            background: #c0392b;
            border-color: #c0392b;
            border-radius: 8px;
            font-size: 14px;
            padding: 10px 12px;
            font-weight: 600;
        }
        .btn-login:hover {
            background: #a93226;
            border-color: #a93226;
        }
    </style>
</head>
<body>
    <div class="card login-card">
        <div class="login-header">
            <h4><i class="bi bi-fire me-2"></i>ZRC Fire Alarm</h4>
            <p>Retailing System Admin Login</p>
        </div>
        <div class="card-body p-4">
            @if (session('status'))
                <div class="alert alert-info py-2">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input
                        id="username"
                        type="text"
                        name="username"
                        value="{{ old('username') }}"
                        class="form-control @error('username') is-invalid @enderror"
                        required
                        autofocus
                        autocomplete="username"
                    >
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        required
                        autocomplete="current-password"
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-danger btn-login w-100">Log in</button>
            </form>
        </div>
    </div>
</body>
</html>
