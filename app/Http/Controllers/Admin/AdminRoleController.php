<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminRoleController extends Controller
{
    public static array $availableModules = [
        'dashboard'          => 'Dashboard Overview',
        'analytics'          => 'Analytics Website',
        'services'           => 'Manajemen Produk & Tableware',
        'service_categories' => 'Kategori Produk',
        'gallery'            => 'Galeri & Portofolio',
        'articles'           => 'Artikel & Blog',
        'testimonials'       => 'Testimoni Pelanggan',
        'clients'            => 'Client & Partner',
        'leads'              => 'Leads & Request Order',
        'wa'                 => 'Pengaturan WA & Mode Lead',
        'page_management'    => 'Page Management',
        'settings'           => 'Pengaturan Situs',
        'roles'              => 'Manajemen Peran & User Admin',
    ];

    public function index()
    {
        $users = User::orderBy('id', 'asc')->get();
        $modules = self::$availableModules;

        return view('admin.roles.index', compact('users', 'modules'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:150',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|string|min:6',
            'role'        => 'required|string|in:admin,superadmin',
            'permissions' => 'nullable|array',
            'is_active'   => 'boolean',
        ]);

        $validated['password']  = Hash::make($validated['password']);
        $validated['is_active'] = $request->boolean('is_active', true);

        // If role is superadmin, nullify permissions to grant full access
        if ($validated['role'] === 'superadmin') {
            $validated['permissions'] = null;
        } else {
            $validated['permissions'] = array_values($request->input('permissions', []));
        }

        User::create($validated);

        return redirect()->route('admin.roles.index')->with('success', 'User admin baru berhasil ditambahkan.');
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:150',
            'email'       => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'role'        => 'required|string|in:admin,superadmin',
            'permissions' => 'nullable|array',
            'is_active'   => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        // Prevent deactivating own account
        if ($user->id === session('admin_id')) {
            $validated['is_active'] = true;
            $validated['role']      = 'superadmin';
        }

        if ($validated['role'] === 'superadmin') {
            $validated['permissions'] = null;
        } else {
            $validated['permissions'] = array_values($request->input('permissions', []));
        }

        $user->update($validated);

        return redirect()->route('admin.roles.index')->with('success', 'Peran & hak akses user berhasil diperbarui.');
    }

    public function changePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ], [
            'password.required'  => 'Password baru wajib diisi.',
            'password.min'       => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.roles.index')->with('success', 'Password user ' . $user->name . ' berhasil diubah.');
    }

    public function destroy(User $user)
    {
        if ($user->id === 1 || $user->id === session('admin_id')) {
            return back()->with('error', 'Akun Superadmin / Akun Anda sendiri tidak dapat dihapus.');
        }

        $user->delete();

        return redirect()->route('admin.roles.index')->with('success', 'User admin berhasil dihapus.');
    }
}
