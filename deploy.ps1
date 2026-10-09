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
DEPLOY_DIR="/home/u664715641/domains/pusatpiringkeramik.com"
ALT_DEPLOY_DIR="/home/u664715641/domains/pusatpiringkeramik.hvmdigital.id"
REPO_URL="https://github.com/dgtilhammln-cmd/pusatpiringkeramik.com.git"

deploy_target() {
    TARGET_DIR="$1"
    echo "=== Deploying to target: $TARGET_DIR ==="
    if [ -d "$TARGET_DIR/.git" ]; then
        echo "--- [UPDATE] Repo ada, menarik update dari GitHub..."
        cd "$TARGET_DIR"
        git fetch origin main
        git reset --hard origin/main
    elif [ -d "$TARGET_DIR" ]; then
        echo "--- Setup repo di $TARGET_DIR..."
        cd "$TARGET_DIR"
        git init
        git remote add origin "$REPO_URL" 2>/dev/null || true
        git fetch origin main
        git reset --hard origin/main
    fi

    if [ -f "$TARGET_DIR/.env" ]; then
        sed -i 's/APP_DEBUG=false/APP_DEBUG=true/g' "$TARGET_DIR/.env"
        sed -i 's|APP_URL=.*|APP_URL=https://pusatpiringkeramik.com|g' "$TARGET_DIR/.env"
    fi

    if [ -d "$TARGET_DIR/.git" ]; then
        cd "$TARGET_DIR"
        php artisan migrate --force 2>/dev/null || true
        mkdir -p "$TARGET_DIR/public_html"
        [ -f "$TARGET_DIR/public/index.php" ]  && cp -f "$TARGET_DIR/public/index.php"  "$TARGET_DIR/public_html/index.php"
        [ -f "$TARGET_DIR/public/.htaccess" ]  && cp -f "$TARGET_DIR/public/.htaccess"   "$TARGET_DIR/public_html/.htaccess"
        [ -f "$TARGET_DIR/public/robots.txt" ] && cp -f "$TARGET_DIR/public/robots.txt"  "$TARGET_DIR/public_html/robots.txt"
        [ -f "$TARGET_DIR/public/llms.txt" ]   && cp -f "$TARGET_DIR/public/llms.txt"    "$TARGET_DIR/public_html/llms.txt"
        # Force overwrite sitemap.xml with clean version from repo
        rm -f "$TARGET_DIR/public_html/sitemap.xml" "$TARGET_DIR/public_html/sitemap.xsl"
        [ -f "$TARGET_DIR/public/sitemap.xml" ] && cp -f "$TARGET_DIR/public/sitemap.xml" "$TARGET_DIR/public_html/sitemap.xml"
        # Google verification file — do NOT auto-delete (may still be needed for Search Console)
        # rm -f "$TARGET_DIR/public_html/google2d6265e5f3ef15fd.html" 2>/dev/null || true
        rm -f "$TARGET_DIR/public_html/storage"
        ln -s "$TARGET_DIR/storage/app/public" "$TARGET_DIR/public_html/storage" 2>/dev/null || true
        chmod -R 775 "$TARGET_DIR/storage" "$TARGET_DIR/bootstrap/cache" 2>/dev/null || true
        php artisan view:clear
        php artisan cache:clear
        php artisan route:clear
        php artisan config:clear
        php artisan optimize
    fi
}

deploy_target "$DEPLOY_DIR"
[ -d "$ALT_DEPLOY_DIR" ] && deploy_target "$ALT_DEPLOY_DIR"

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
# Copy robots.txt, llms.txt & sitemap.xml to public_html
if [ -f "$DEPLOY_DIR/public/robots.txt" ]; then
    cp -f "$DEPLOY_DIR/public/robots.txt" "$DEPLOY_DIR/public_html/robots.txt"
fi
if [ -f "$DEPLOY_DIR/public/llms.txt" ]; then
    cp -f "$DEPLOY_DIR/public/llms.txt" "$DEPLOY_DIR/public_html/llms.txt"
fi
# Force overwrite sitemap.xml — remove old/corrupt file first
rm -f "$DEPLOY_DIR/public_html/sitemap.xml" "$DEPLOY_DIR/public_html/sitemap.xsl"
if [ -f "$DEPLOY_DIR/public/sitemap.xml" ]; then
    cp -f "$DEPLOY_DIR/public/sitemap.xml" "$DEPLOY_DIR/public_html/sitemap.xml"
fi
# Remove old Google Search Console verification file
rm -f "$DEPLOY_DIR/public_html/google2d6265e5f3ef15fd.html" 2>/dev/null || true
echo "--- Copied robots.txt, llms.txt, sitemap.xml to public_html!"
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
