<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gunakan custom pagination view dari folder components agar tidak ter-exclude saat deploy
        Paginator::defaultView('components.pagination');

        // Paksa HTTPS di Production agar tidak kena error Mixed Content di Hostinger
        if (config('app.env') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Share $companyName & $companyTagline ke SEMUA view — sumber dari settings DB
        View::share('companyName', Setting::get('company_name', config('app.name')));
        View::share('companyTagline', Setting::get('company_tagline', ''));
    }
}
