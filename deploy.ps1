# ============================================================
# DEPLOY SCRIPT — pusatpiringkeramik.hvmdigital.id
# Cara pakai: ./deploy
# ============================================================

$SSH_HOST = "46.202.186.86"
$SSH_PORT = "65002"
$SSH_USER = "u664715641"

Write-Host ""
Write-Host "==============================================" -ForegroundColor Cyan
Write-Host "  DEPLOY - pusatpiringkeramik.hvmdigital.id" -ForegroundColor Cyan
Write-Host "==============================================" -ForegroundColor Cyan
Write-Host ""

# ── STEP 1: Commit lokal ──────────────────────────────────
Write-Host "[1/3] Commit perubahan lokal..." -ForegroundColor Yellow
git add .
git commit -m "Deploy: update terbaru"

# ── STEP 2: Push ke GitHub ───────────────────────────────
Write-Host ""
Write-Host "[2/3] Push ke GitHub..." -ForegroundColor Yellow
git push origin main
if ($LASTEXITCODE -ne 0) {
    Write-Host "[ERROR] Gagal push ke GitHub!" -ForegroundColor Red
    pause
    exit 1
}
Write-Host "Push berhasil!" -ForegroundColor Green

# ── STEP 3: Deploy ke Hosting ────────────────────────────
Write-Host ""
Write-Host "[3/3] Deploy ke Hosting..." -ForegroundColor Yellow

# PENTING: Pakai @'...'@ (single-quote) agar PowerShell TIDAK expand variabel
# Semua $ di sini adalah milik bash, bukan PowerShell
$bashScript = @'
#!/bin/bash
DEPLOY_DIR="/home/u664715641/domains/pusatpiringkeramik.hvmdigital.id"
REPO_URL="https://github.com/dgtilhammln-cmd/pusatpiringkeramik.com.git"

echo "=== Cek direktori hosting ==="

if [ -d "$DEPLOY_DIR/.git" ]; then
    echo "--- [UPDATE] Repo sudah ada, menarik update dari GitHub..."
    cd "$DEPLOY_DIR"
    git fetch origin main
    git reset --hard origin/main
    echo "--- Update selesai!"
else
    echo "--- [SETUP PERTAMA] Membuat folder dan clone dari GitHub..."
    mkdir -p "$DEPLOY_DIR"
    cd "$DEPLOY_DIR"
    git init
    git remote add origin "$REPO_URL"
    git fetch origin main
    git reset --hard origin/main
    echo "--- Clone selesai!"

    echo "--- Membuat file .env..."
    cat > "$DEPLOY_DIR/.env" << 'ENVEOF'
APP_NAME="Pusat Piring Keramik"
APP_ENV=production
APP_KEY=base64:8v7nZVLpqpXmf3DacvEgc4/ohLjd4ABdBqOc5hTG5rg=
APP_DEBUG=false
APP_URL=https://pusatpiringkeramik.hvmdigital.id
APP_LOCALE=id
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=id_ID
APP_MAINTENANCE_DRIVER=file
BCRYPT_ROUNDS=12
LOG_CHANNEL=stack
LOG_STACK=single
LOG_LEVEL=debug
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=u664715641_PIRINGKERAMIK
DB_USERNAME=u664715641_PIRINGKERAMIK
DB_PASSWORD=Piringkeramik23
SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null
FILESYSTEM_DISK=public
QUEUE_CONNECTION=database
CACHE_STORE=file
MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_FROM_ADDRESS=admin@pusatpiringkeramik.com
MAIL_FROM_NAME="Pusat Piring Keramik"
ENVEOF
    echo "--- .env berhasil dibuat!"
    cd "$DEPLOY_DIR"
    php artisan key:generate --force
fi

# Ensure APP_DEBUG=false in existing .env file
if [ -f "$DEPLOY_DIR/.env" ]; then
    sed -i 's/APP_DEBUG=true/APP_DEBUG=false/g' "$DEPLOY_DIR/.env"
fi

echo ""
echo "--- Menjalankan artisan commands..."
cd "$DEPLOY_DIR"
php artisan migrate --force
# Note: Seeders disabled during normal deploys to preserve custom data:
# php artisan db:seed --class=DatabaseSeeder --force
# php artisan db:seed --class=HeroSlideSeeder --force

echo "--- Fix storage symlink & sync public_html..."
mkdir -p "$DEPLOY_DIR/public_html"
if [ -f "$DEPLOY_DIR/public/index.php" ]; then
    cp -f "$DEPLOY_DIR/public/index.php" "$DEPLOY_DIR/public_html/index.php"
fi
if [ -f "$DEPLOY_DIR/public/.htaccess" ]; then
    cp -f "$DEPLOY_DIR/public/.htaccess" "$DEPLOY_DIR/public_html/.htaccess"
fi
# Hapus file statis robots.txt & llms.txt agar route Laravel yang aktif
rm -f "$DEPLOY_DIR/public/robots.txt"
rm -f "$DEPLOY_DIR/public/llms.txt"
rm -f "$DEPLOY_DIR/public_html/robots.txt"
rm -f "$DEPLOY_DIR/public_html/llms.txt"
echo "--- Removed static robots.txt & llms.txt (using Laravel routes)"
rm -f "$DEPLOY_DIR/public_html/storage"
ln -s "$DEPLOY_DIR/storage/app/public" "$DEPLOY_DIR/public_html/storage"
chmod -R 775 "$DEPLOY_DIR/storage" "$DEPLOY_DIR/bootstrap/cache"
echo "--- Symlink storage & public_html OK!"

php artisan view:clear
php artisan cache:clear
php artisan route:clear
php artisan config:clear
php artisan optimize
php artisan view:cache
php artisan event:cache

echo ""
echo "--- Konversi gambar ke WebP (batch)..."
php artisan images:optimize-webp 2>/dev/null || echo "(WebP batch: skip, sudah dikonversi)"

echo ""
echo "--- DEPLOY SELESAI! ---"
'@

# Tulis script ke file temp lalu pipe ke SSH bash -s
$tmpScript = "$env:TEMP\deploy_piringkeramik.sh"
[System.IO.File]::WriteAllText($tmpScript, $bashScript, [System.Text.Encoding]::UTF8)

Get-Content $tmpScript -Raw | & ssh -p $SSH_PORT -o ConnectTimeout=30 -o ServerAliveInterval=20 -o ServerAliveCountMax=6 -o StrictHostKeyChecking=no "${SSH_USER}@${SSH_HOST}" "bash -s"

Remove-Item $tmpScript -ErrorAction SilentlyContinue

Write-Host ""
Write-Host "==============================================" -ForegroundColor Green
Write-Host "  Deploy Berhasil!" -ForegroundColor Green
Write-Host "  https://pusatpiringkeramik.hvmdigital.id" -ForegroundColor Green
Write-Host "==============================================" -ForegroundColor Green
