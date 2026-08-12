<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminAnalyticsController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\AdminClientController;
use App\Http\Controllers\Admin\AdminWaController;
use App\Http\Controllers\Admin\AdminTestimonialController;
use App\Http\Controllers\Admin\AdminLeadController;
use App\Http\Controllers\Admin\AdminHeroSlideController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['track.pageview'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about', [AboutController::class, 'index'])->name('about');

    // Products (was /services) — Cyclevent turbine ventilator products
    Route::get('/products', [ServiceController::class, 'index'])->name('products');
    Route::get('/products/{slug}', [ServiceController::class, 'show'])->name('products.show');

    // Legacy redirect for /services → /products
    Route::get('/services', function () { return redirect()->route('products', [], 301); });
    Route::get('/services/{slug}', function ($slug) { return redirect()->route('products.show', $slug, 301); });

    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
    Route::get('/gallery/{slug}', [GalleryController::class, 'show'])->name('gallery.show');
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles');
    Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
});

// Lead / Request Order (AJAX - no page tracking)
Route::post('/request-order', [LeadController::class, 'store'])->name('lead.store');

// Sitemap & robots
Route::get('/sitemap.xml', [SitemapController::class, 'index']);
Route::get('/sitemap', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', function () {
    $content = "User-agent: *\nAllow: /\n\nSitemap: " . url('/sitemap.xml');
    return response($content, 200)->header('Content-Type', 'text/plain');
});

// Deployment Helper Route untuk Hostinger (Hapus route ini setelah selesai deploy!)
Route::get('/deploy-hostinger', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        return 'SUKSES! Symlink storage berhasil dibuat dan Cache berhasil dibersihkan. Website siap digunakan. Harap hapus route ini demi keamanan.';
    } catch (\Exception $e) {
        return 'ERROR: ' . $e->getMessage();
    }
});

// Tracking endpoint
Route::post('/track/{type}', [TrackingController::class, 'track'])->name('track');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('/analytics', [AdminAnalyticsController::class, 'index'])->name('admin.analytics');
        Route::get('/analytics/data', [AdminAnalyticsController::class, 'data'])->name('admin.analytics.data');
        Route::get('/analytics/realtime', [AdminAnalyticsController::class, 'realtime'])->name('admin.analytics.realtime');
        Route::get('/analytics/export/xls', [AdminAnalyticsController::class, 'exportXls'])->name('admin.analytics.export_xls');
        Route::get('/analytics/export/pdf', [AdminAnalyticsController::class, 'exportPdf'])->name('admin.analytics.export_pdf');

        Route::get('/settings', [AdminSettingsController::class, 'index'])->name('admin.settings');
        Route::post('/settings', [AdminSettingsController::class, 'update'])->name('admin.settings.update');
        Route::post('upload-image', [\App\Http\Controllers\Admin\AdminUploadController::class, 'uploadImage'])->name('admin.upload.image');

        // Leads / Inquiries
        Route::get('/leads/export', [AdminLeadController::class, 'export'])->name('admin.leads.export');
        Route::get('/leads/export-pdf', [AdminLeadController::class, 'exportPdf'])->name('admin.leads.export_pdf');
        Route::post('/leads/mark-read', [AdminLeadController::class, 'markAllRead'])->name('admin.leads.mark_read');
        Route::get('/leads', [AdminLeadController::class, 'index'])->name('admin.leads.index');
        Route::get('/leads/{lead}', [AdminLeadController::class, 'show'])->name('admin.leads.show');
        Route::post('/leads/{lead}/status', [AdminLeadController::class, 'updateStatus'])->name('admin.leads.status');
        Route::post('/leads/{lead}/notes', [AdminLeadController::class, 'updateNote'])->name('admin.leads.notes');
        Route::delete('/leads/{lead}', [AdminLeadController::class, 'destroy'])->name('admin.leads.destroy');

        // Products (admin uses "services" internally for backward compat)
        Route::get('services/template', [AdminServiceController::class, 'downloadTemplate'])->name('admin.services.template');
        Route::post('services/import', [AdminServiceController::class, 'importCsv'])->name('admin.services.import');
        Route::resource('services', AdminServiceController::class)->names([
            'index'   => 'admin.services.index',   'create'  => 'admin.services.create',
            'store'   => 'admin.services.store',    'show'    => 'admin.services.show',
            'edit'    => 'admin.services.edit',     'update'  => 'admin.services.update',
            'destroy' => 'admin.services.destroy',
        ]);

        Route::resource('gallery', AdminGalleryController::class)->names([
            'index'   => 'admin.gallery.index',   'create'  => 'admin.gallery.create',
            'store'   => 'admin.gallery.store',   'show'    => 'admin.gallery.show',
            'edit'    => 'admin.gallery.edit',    'update'  => 'admin.gallery.update',
            'destroy' => 'admin.gallery.destroy',
        ]);

        Route::resource('articles', AdminArticleController::class)->names([
            'index'   => 'admin.articles.index',   'create'  => 'admin.articles.create',
            'store'   => 'admin.articles.store',   'show'    => 'admin.articles.show',
            'edit'    => 'admin.articles.edit',    'update'  => 'admin.articles.update',
            'destroy' => 'admin.articles.destroy',
        ]);

        Route::resource('clients', AdminClientController::class)->names([
            'index'   => 'admin.clients.index',   'create'  => 'admin.clients.create',
            'store'   => 'admin.clients.store',   'show'    => 'admin.clients.show',
            'edit'    => 'admin.clients.edit',    'update'  => 'admin.clients.update',
            'destroy' => 'admin.clients.destroy',
        ]);

        Route::resource('testimonials', AdminTestimonialController::class)->names([
            'index'   => 'admin.testimonials.index',   'create'  => 'admin.testimonials.create',
            'store'   => 'admin.testimonials.store',   'show'    => 'admin.testimonials.show',
            'edit'    => 'admin.testimonials.edit',    'update'  => 'admin.testimonials.update',
            'destroy' => 'admin.testimonials.destroy',
        ]);

        Route::get('/wa-settings', [AdminWaController::class, 'index'])->name('admin.wa.index');
        Route::post('/wa-settings', [AdminWaController::class, 'update'])->name('admin.wa.update');
        Route::post('/wa-settings/add', [AdminWaController::class, 'store'])->name('admin.wa.store');
        Route::delete('/wa-settings/{id}', [AdminWaController::class, 'destroy'])->name('admin.wa.destroy');

        Route::resource('hero-slides', AdminHeroSlideController::class)->names([
            'index'   => 'admin.hero_slides.index',   'create'  => 'admin.hero_slides.create',
            'store'   => 'admin.hero_slides.store',   'show'    => 'admin.hero_slides.show',
            'edit'    => 'admin.hero_slides.edit',    'update'  => 'admin.hero_slides.update',
            'destroy' => 'admin.hero_slides.destroy',
        ]);
    });
});
