@echo off
echo ==============================================
echo  DEPLOY - pusatpiringkeramik.hvmdigital.id
echo ==============================================

echo.
echo ==============================================
echo 1. Menyiapkan ^& Commit Perubahan Lokal...
echo ==============================================
git add .
git commit -m "Deploy: update terbaru"

echo.
echo ==============================================
echo 2. Push update ke Github...
echo ==============================================
git push origin main
if %errorlevel% neq 0 (
    echo [ERROR] Gagal push ke Github! Periksa koneksi atau credentials.
    pause
    exit /b 1
)

echo.
echo ==============================================
echo 3. Deploy ke Hosting pusatpiringkeramik.hvmdigital.id
echo ==============================================
ssh -p 65002 u664715641@46.202.186.86 "DEPLOY_DIR=~/domains/pusatpiringkeramik.hvmdigital.id/public_html && if [ -d $DEPLOY_DIR/.git ]; then echo '--- [UPDATE] Menarik update dari Github...' && cd $DEPLOY_DIR && git fetch origin main && git reset --hard origin/main; else echo '--- [SETUP PERTAMA] Membuat folder dan clone dari Github...' && mkdir -p $DEPLOY_DIR && cd $DEPLOY_DIR && git init && git remote add origin https://github.com/dgtilhammln-cmd/pusatpiringkeramik.com.git && git fetch origin main && git reset --hard origin/main && echo '--- Membuat file .env...' && cat > $DEPLOY_DIR/.env << 'ENVEOF' APP_NAME=\"Pusat Piring Keramik\" APP_ENV=production APP_KEY=base64:8v7nZVLpqpXmf3DacvEgc4/ohLjd4ABdBqOc5hTG5rg= APP_DEBUG=false APP_URL=https://pusatpiringkeramik.hvmdigital.id APP_LOCALE=id APP_FALLBACK_LOCALE=en DB_CONNECTION=mysql DB_HOST=127.0.0.1 DB_PORT=3306 DB_DATABASE=u664715641_PIRINGKERAMIK DB_USERNAME=u664715641_PIRINGKERAMIK DB_PASSWORD=Piringkeramik23 SESSION_DRIVER=file SESSION_LIFETIME=120 FILESYSTEM_DISK=public QUEUE_CONNECTION=database CACHE_STORE=file MAIL_MAILER=log MAIL_FROM_ADDRESS=\"admin@pusatpiringkeramik.com\" ENVEOF && echo '.env berhasil dibuat!'; fi && cd ~/domains/pusatpiringkeramik.hvmdigital.id/public_html && echo '--- Menjalankan artisan commands...' && php artisan key:generate --force && php artisan migrate --force && php artisan storage:link && php artisan view:clear && php artisan cache:clear && php artisan route:clear && php artisan config:clear && php artisan optimize && echo '--- Deploy selesai! ---'"

echo.
echo ==============================================
echo  Deploy Berhasil! - pusatpiringkeramik.hvmdigital.id
echo ==============================================
pause
