# ============================================================
# DEPLOY SCRIPT — pusatpiringkeramik.hvmdigital.id
# Cara pakai: ./deploy
# ============================================================

$SSH_HOST   = "46.202.186.86"
$SSH_PORT   = "65002"
$SSH_USER   = "u664715641"
$DEPLOY_DIR = "~/domains/pusatpiringkeramik.hvmdigital.id/public_html"
$REPO_URL   = "https://github.com/dgtilhammln-cmd/pusatpiringkeramik.com.git"

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

$envContent = @"
APP_NAME=`"Pusat Piring Keramik`"
APP_ENV=production
APP_KEY=base64:8v7nZVLpqpXmf3DacvEgc4/ohLjd4ABdBqOc5hTG5rg=
APP_DEBUG=false
APP_URL=https://pusatpiringkeramik.hvmdigital.id
APP_LOCALE=id
APP_FALLBACK_LOCALE=en
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=u664715641_PIRINGKERAMIK
DB_USERNAME=u664715641_PIRINGKERAMIK
DB_PASSWORD=Piringkeramik23
SESSION_DRIVER=file
SESSION_LIFETIME=120
FILESYSTEM_DISK=public
QUEUE_CONNECTION=database
CACHE_STORE=file
MAIL_MAILER=log
MAIL_FROM_ADDRESS=admin@pusatpiringkeramik.com
MAIL_FROM_NAME=Pusat Piring Keramik
"@

$sshScript = @"
DEPLOY_DIR=$DEPLOY_DIR
REPO_URL=$REPO_URL

if [ -d \`$DEPLOY_DIR/.git ]; then
    echo '--- [UPDATE] Repo sudah ada, menarik update...'
    cd \`$DEPLOY_DIR
    git fetch origin main
    git reset --hard origin/main
else
    echo '--- [SETUP PERTAMA] Membuat folder dan clone dari GitHub...'
    mkdir -p \`$DEPLOY_DIR
    cd \`$DEPLOY_DIR
    git init
    git remote add origin \`$REPO_URL
    git fetch origin main
    git reset --hard origin/main
    echo '--- Membuat .env...'
    cat > \`$DEPLOY_DIR/.env << 'ENVEOF'
$envContent
ENVEOF
    echo '.env selesai dibuat!'
fi

echo '--- Menjalankan artisan...'
cd \`$DEPLOY_DIR
php artisan key:generate --force
php artisan migrate --force
php artisan storage:link
php artisan view:clear
php artisan cache:clear
php artisan route:clear
php artisan config:clear
php artisan optimize
echo '--- Deploy selesai! ---'
"@

& ssh -p $SSH_PORT "${SSH_USER}@${SSH_HOST}" $sshScript

Write-Host ""
Write-Host "==============================================" -ForegroundColor Green
Write-Host "  Deploy Berhasil!" -ForegroundColor Green
Write-Host "  https://pusatpiringkeramik.hvmdigital.id" -ForegroundColor Green
Write-Host "==============================================" -ForegroundColor Green
