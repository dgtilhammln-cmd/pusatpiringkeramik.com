<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | CV. Karya Perdana Teknik</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    @if(file_exists(public_path('build/assets')) && count(glob(public_path('build/assets/*.css'))) > 0)
        @vite(['resources/css/app.css'])
    @else
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif
    <style>body{font-family:'Plus Jakarta Sans',sans-serif;background:#0A0A0A;color:#fff;display:flex;align-items:center;justify-content:center;min-height:100vh;margin:0;}</style>
</head>
<body>
<div style="width:100%;max-width:420px;padding:1.5rem;">
    <div style="text-align:center;margin-bottom:2.5rem;">
        <div style="width:56px;height:56px;background:#F5A623;display:flex;align-items:center;justify-content:center;font-weight:900;color:#000;font-size:1.25rem;margin:0 auto 1rem;">KPT</div>
        <h1 style="font-size:1.5rem;font-weight:800;margin:0 0 0.375rem;">Admin Panel</h1>
        <p style="color:#A1A1AA;font-size:0.875rem;margin:0;">CV. Karya Perdana Teknik</p>
    </div>

    @if(session('error'))
    <div style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);padding:1rem;margin-bottom:1.5rem;border-radius:4px;text-align:center;color:#f87171;font-size:0.875rem;">{{ session('error') }}</div>
    @endif

    <div style="background:#18181B;border:1px solid #27272A;padding:2.5rem;border-radius:8px;">
        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <div style="margin-bottom:1.25rem;">
                <label class="form-label">Email Admin</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="admin@karyaperdanateknik.co.id" required autofocus>
                @error('email')<p style="color:#f87171;font-size:0.8125rem;margin:0.25rem 0 0;">{{ $message }}</p>@enderror
            </div>
            <div style="margin-bottom:1.75rem;">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" placeholder="••••••••" required>
                @error('password')<p style="color:#f87171;font-size:0.8125rem;margin:0.25rem 0 0;">{{ $message }}</p>@enderror
            </div>
            <button type="submit" class="btn-primary" style="width:100%;justify-content:center;font-size:1rem;padding:0.875rem;">
                Masuk ke Admin Panel
            </button>
        </form>
    </div>
    <div style="text-align:center;margin-top:1.5rem;">
        <a href="{{ route('home') }}" style="font-size:0.8125rem;color:#A1A1AA;text-decoration:none;">← Kembali ke Website</a>
    </div>
</div>
</body>
</html>
