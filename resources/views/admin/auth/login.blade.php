<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | CV. Karya Perdana Teknik</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    @if(file_exists(public_path('build/assets')) && count(glob(public_path('build/assets/*.css'))) > 0)
        @vite(['resources/css/app.css'])
    @else
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #080808;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            background-image: 
                linear-gradient(rgba(255, 215, 0, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 215, 0, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            position: relative;
        }
        /* Industrial geometric accents */
        body::before {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 300px; height: 300px;
            background: radial-gradient(circle at top right, rgba(255,215,0,0.1) 0%, transparent 70%);
            z-index: -1;
        }
        body::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0;
            width: 400px; height: 400px;
            background: radial-gradient(circle at bottom left, rgba(255,215,0,0.05) 0%, transparent 70%);
            z-index: -1;
        }

        .login-wrapper {
            width: 100%;
            max-width: 420px;
            padding: 2rem;
            position: relative;
            z-index: 10;
        }

        .login-box {
            background: rgba(16, 16, 16, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-top: 3px solid #FFD700;
            padding: 3rem 2.5rem;
            position: relative;
            /* Sharp industrial edges */
            border-radius: 2px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6);
        }

        .login-box::before {
            content: '';
            position: absolute;
            bottom: -1px; right: -1px;
            width: 20px; height: 20px;
            border-bottom: 2px solid #FFD700;
            border-right: 2px solid #FFD700;
        }
        .login-box::after {
            content: '';
            position: absolute;
            top: -1px; left: -1px;
            width: 20px; height: 20px;
            border-top: 2px solid #FFD700;
            border-left: 2px solid #FFD700;
            pointer-events: none;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .logo-container img {
            max-height: 50px;
            margin-bottom: 1rem;
        }
        .logo-placeholder {
            width: 56px; height: 56px;
            background: #FFD700;
            display: flex; align-items: center; justify-content: center;
            font-weight: 900; color: #000; font-size: 1.25rem;
            margin: 0 auto 1rem;
            border-radius: 2px;
        }

        .form-label-geo {
            color: #A0A0A8;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
            font-size: 0.6875rem;
            font-weight: 700;
            display: block;
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-geo {
            background: #080808;
            border: 1px solid rgba(255, 255, 255, 0.15);
            width: 100%;
            color: #fff;
            font-size: 0.9375rem;
            font-family: 'Montserrat', sans-serif;
            border-radius: 2px;
            outline: none;
            padding: 0.875rem 1rem;
            transition: all 0.2s;
        }
        .input-geo:focus {
            border-color: #FFD700;
            box-shadow: 0 0 0 1px #FFD700;
        }

        .toggle-password {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #A0A0A8;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s;
        }
        .toggle-password:hover {
            color: #FFD700;
        }

        .btn-geo {
            background: #FFD700;
            color: #000;
            font-weight: 800;
            font-family: 'Montserrat', sans-serif;
            border: none;
            cursor: pointer;
            width: 100%;
            padding: 1rem;
            font-size: 0.9375rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-radius: 2px;
            transition: all 0.2s;
            margin-top: 1rem;
            position: relative;
            overflow: hidden;
        }
        .btn-geo:hover {
            background: #E6C200;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(255, 215, 0, 0.2);
        }
        .btn-geo:active {
            transform: translateY(0);
        }

        .error-box {
            background: rgba(239, 68, 68, 0.1);
            border-left: 3px solid #ef4444;
            padding: 1rem;
            margin-bottom: 1.5rem;
            color: #f87171;
            font-size: 0.875rem;
            border-radius: 0 2px 2px 0;
        }
    </style>
</head>
<body>

@php 
    $logo = \App\Models\Setting::get('logo');
@endphp

<div class="login-wrapper">
    <div class="login-box">
        <div class="logo-container">
            @if($logo)
                <img src="{{ asset('storage/'.$logo) }}" alt="Logo KPT">
            @else
                <div class="logo-placeholder">KPT</div>
            @endif
            <h1 style="font-size:1.375rem;font-weight:800;margin:0 0 0.25rem;letter-spacing:-0.03em;">ADMIN PANEL</h1>
            <p style="color:#A0A0A8;font-size:0.8125rem;margin:0;letter-spacing:0.02em;">ACCESS SECURE ZONE</p>
        </div>

        @if(session('error'))
            <div class="error-box">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <div class="input-group">
                <label class="form-label-geo">Email Admin</label>
                <input type="email" name="email" value="{{ old('email') }}" class="input-geo" placeholder="admin@karyaperdanateknik.co.id" required autofocus>
                @error('email')<p style="color:#f87171;font-size:0.75rem;margin:0.375rem 0 0;">{{ $message }}</p>@enderror
            </div>
            
            <div class="input-group">
                <label class="form-label-geo">Password</label>
                <div style="position:relative;">
                    <input type="password" name="password" id="password" class="input-geo" style="padding-right:3rem;" placeholder="••••••••" required>
                    <button type="button" class="toggle-password" id="toggle-btn" aria-label="Toggle password visibility">
                        <svg id="eye-icon" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
                @error('password')<p style="color:#f87171;font-size:0.75rem;margin:0.375rem 0 0;">{{ $message }}</p>@enderror
            </div>

            <button type="submit" class="btn-geo">
                System Login
            </button>
        </form>
    </div>
    
    <div style="text-align:center;margin-top:2rem;">
        <a href="{{ route('home') }}" style="font-size:0.75rem;color:#A0A0A8;text-decoration:none;letter-spacing:0.05em;text-transform:uppercase;transition:color 0.2s;" onmouseover="this.style.color='#FFD700'" onmouseout="this.style.color='#A0A0A8'">
            <span style="margin-right:0.5rem;">←</span> Return to Website
        </a>
    </div>
</div>

<script>
    const passInput = document.getElementById('password');
    const toggleBtn = document.getElementById('toggle-btn');
    const eyeIcon = document.getElementById('eye-icon');

    toggleBtn.addEventListener('click', function() {
        if (passInput.type === 'password') {
            passInput.type = 'text';
            eyeIcon.innerHTML = `
                <path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"></path>
                <line x1="1" y1="1" x2="23" y2="23"></line>
            `;
        } else {
            passInput.type = 'password';
            eyeIcon.innerHTML = `
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
            `;
        }
    });
</script>
</body>
</html>
