<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class AdminAuth
{
    public static array $moduleRoutePrefixes = [
        'dashboard'          => ['admin.dashboard'],
        'analytics'          => ['admin.analytics'],
        'services'           => ['admin.services'],
        'service_categories' => ['admin.service-categories'],
        'gallery'            => ['admin.gallery'],
        'articles'           => ['admin.articles'],
        'testimonials'       => ['admin.testimonials'],
        'clients'            => ['admin.clients'],
        'leads'              => ['admin.leads'],
        'wa'                 => ['admin.wa'],
        'page_management'    => ['admin.page_management', 'admin.hero_slides'],
        'settings'           => ['admin.settings'],
        'roles'              => ['admin.roles'],
    ];

    public function handle(Request $request, Closure $next)
    {
        if (!session('admin_logged_in') || !session('admin_id')) {
            return redirect('/admin/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = User::find(session('admin_id'));

        if (!$user || !$user->is_active) {
            session()->forget(['admin_logged_in', 'admin_id', 'admin_name', 'admin_email']);
            return redirect('/admin/login')->with('error', 'Akun Anda tidak aktif atau telah dihapus.');
        }

        // Share logged in admin user instance with all Blade views
        view()->share('currentAdminUser', $user);

        // Check module permission for the requested route
        $routeName = $request->route() ? $request->route()->getName() : null;
        if ($routeName) {
            foreach (self::$moduleRoutePrefixes as $moduleKey => $prefixes) {
                foreach ($prefixes as $prefix) {
                    if (str_starts_with($routeName, $prefix)) {
                        if (!$user->hasPermission($moduleKey)) {
                            // Returns 404 as explicitly requested by user for unauthorized route access
                            abort(404);
                        }
                        break 2;
                    }
                }
            }
        }

        return $next($request);
    }
}
