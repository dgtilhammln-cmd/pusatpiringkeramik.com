# ══════════════════════════════════════════════════════════
# Deploy Script (Git Pull) — PT Biner
# Target: Hostinger
# ══════════════════════════════════════════════════════════

$SSH_HOST = "46.202.186.86"
$SSH_PORT = "65002"
$SSH_USER = "u664715641"
$REMOTE_DIR = "/home/u664715641/domains/ptbinercoid.hvmdigital.id"

Write-Host "🚀 Memulai deploy ke Hostinger via Git..." -ForegroundColor Cyan
Write-Host ""

Write-Host "⚙️ Mengunggah file .env ke server..." -ForegroundColor Yellow
& scp -P $SSH_PORT .env "${SSH_USER}@${SSH_HOST}:${REMOTE_DIR}/.env"

$RemoteCommands = @"
cd $REMOTE_DIR

if [ ! -d ".git" ]; then
    echo '--- 🚀 Menyiapkan Repository Git Pertama Kali ---'
    git init
    git remote add origin https://github.com/dgtilhammln-cmd/ptbiner.co.id.git
    git fetch origin
    
    # Amankan file bawaan Hostinger agar tidak conflict saat checkout
    if [ -f "public_html/default.php" ]; then
        mv public_html/default.php public_html/default.php.bak
    fi
    
    git checkout -f main
else
    echo '--- 📥 Mengambil update dari GitHub ---'
    git fetch origin
    git reset --hard origin/main
fi

echo '--- 📦 Install dependensi (jika ada) ---'
composer install --no-dev --optimize-autoloader

echo '--- 🗄️ Menjalankan Migration ---'
php artisan migrate --force

echo '--- 🧹 Membersihkan & Membangun Cache ---'
php artisan optimize:clear
php artisan config:cache
php artisan view:cache

echo '--- 🔐 Update Permissions ---'
if [ -d "storage" ]; then
    chmod -R 775 storage bootstrap/cache
fi

echo '✅ Deploy Selesai!'
"@

& ssh -p $SSH_PORT "${SSH_USER}@${SSH_HOST}" $RemoteCommands

Write-Host ""
Write-Host "🎉 Server berhasil diupdate!" -ForegroundColor Green
