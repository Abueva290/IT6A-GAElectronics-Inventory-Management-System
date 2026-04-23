<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GJ Electronics - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #1e293b;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-wrapper {
            display: flex;
            width: 900px;
            min-height: 500px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0,0,0,0.4);
        }
        .login-left {
            flex: 1;
            background: linear-gradient(135deg, #1e3a5f, #2d6a9f);
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: white;
        }
        .login-left .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.3rem;
            font-weight: 700;
        }
        .login-left .brand-icon {
            background: rgba(255,255,255,0.2);
            padding: 10px;
            border-radius: 10px;
        }
        .login-left .tag {
            background: rgba(255,255,255,0.15);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
            display: inline-block;
            margin-top: 15px;
        }
        .login-right {
            width: 380px;
            background: white;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .login-right h4 { font-weight: 700; color: #1e293b; }
        .login-right p { color: #64748b; font-size: 0.875rem; margin-bottom: 25px; }
        .form-label { font-weight: 600; font-size: 0.875rem; color: #374151; }
        .form-control {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px 14px 10px 38px;
            font-size: 0.875rem;
        }
        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
        }
        .input-wrapper { position: relative; }
        .input-wrapper i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 0.85rem;
        }
        .btn-login {
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            font-size: 0.95rem;
        }
        .btn-login:hover { background: #2563eb; color: white; }
    </style>
</head>
<body>
<div class="login-wrapper">

    {{-- Left Side --}}
    <div class="login-left">
        <div>
            <div class="brand">
                <div class="brand-icon">
                    <i class="fa fa-shield-halved"></i>
                </div>
                <div>
                    <div>GJ Electronics</div>
                    <div style="font-size:0.7rem; font-weight:400; opacity:0.7">
                        Sales & Inventory Management System
                    </div>
                </div>
            </div>
            <p class="mt-3" style="color:rgba(255,255,255,0.8); font-size:0.9rem">
                Comprehensive sales and inventory management for Fire Safety Equipment, CCTV Systems, and IT Solutions.
            </p>
        </div>

        <div style="padding:0; border-radius:10px; overflow:hidden; position:relative;">
            <img src="{{ asset('images/png.png') }}"
                 alt="GJ Electronics Warehouse"
                 style="width:100%; height:220px; object-fit:cover; object-position:center; border-radius:10px;">
            <div style="position:absolute; bottom:0; left:0; right:0;
                        background:linear-gradient(transparent, rgba(0,0,0,0.65));
                        padding:15px; color:white; font-size:0.85rem;">
                <i class="fa fa-check-circle me-1"></i>Manage Sales & Inventory Easily
            </div>
        </div>

        <div style="font-size:0.75rem; opacity:0.6">
            © 2026 GJ Electronics. All rights reserved.
        </div>
    </div>

    {{-- Right Side --}}
    <div class="login-right">
        <h4>Welcome Back</h4>
        <p>Please sign in to your account</p>

        @if($errors->any())
        <div class="alert alert-danger py-2 mb-3" style="font-size:0.85rem">
            <i class="fa fa-circle-xmark me-1"></i>
            These credentials do not match our records.
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <div class="input-wrapper">
                    <i class="fa fa-user"></i>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email') }}"
                           placeholder="Enter your email" required autofocus>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-wrapper">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="password" class="form-control"
                           placeholder="Enter your password" required>
                </div>
            </div>
            <button type="submit" class="btn-login">
                <i class="fa fa-right-to-bracket me-2"></i>Sign In
            </button>
        </form>
        <div class="text-center mt-3">
            <a href="#" style="font-size:0.85rem; color:#3b82f6; text-decoration:none">
                Forgot Password?
            </a>
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>