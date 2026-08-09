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

$RemoteCommands = @"
cd $REMOTE_DIR
echo '--- 📥 Mengambil update dari GitHub ---'
git fetch origin
git reset --hard origin/main

echo '--- 📦 Install dependensi (jika ada) ---'
composer install --no-dev --optimize-autoloader

echo '--- 🗄️ Menjalankan Migration ---'
php artisan migrate --force

echo '--- 🧹 Membersihkan & Membangun Cache ---'
php artisan optimize:clear
php artisan config:cache
php artisan view:cache

echo '--- 🔐 Update Permissions ---'
chmod -R 775 storage bootstrap/cache

echo '✅ Deploy Selesai!'
"@

& ssh -p $SSH_PORT "${SSH_USER}@${SSH_HOST}" $RemoteCommands

Write-Host ""
Write-Host "🎉 Server berhasil diupdate!" -ForegroundColor Green
