<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@pusatpiringkeramik.com'],
            [
                'name'              => 'Super Admin',
                'email'             => 'admin@pusatpiringkeramik.com',
                'password'          => Hash::make('PiringKeramik@2026!'),
                'role'              => 'admin',
                'is_active'         => true,
                'email_verified_at' => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ]
        );

        $this->command->info('✅ Admin user berhasil dibuat!');
        $this->command->info('   Email    : admin@pusatpiringkeramik.com');
        $this->command->info('   Password : PiringKeramik@2026!');
        $this->command->info('   Login    : https://pusatpiringkeramik.hvmdigital.id/admin/login');
    }
}
