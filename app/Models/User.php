<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'permissions',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'permissions'       => 'array',
            'is_active'         => 'boolean',
        ];
    }

    /**
     * Check if user has permission to access a specific module
     */
    public function hasPermission(string $module): bool
    {
        if (!$this->is_active) {
            return false;
        }

        // Superadmin or null permissions array = full access to everything
        if ($this->role === 'superadmin' || is_null($this->permissions)) {
            return true;
        }

        return in_array($module, $this->permissions ?? []);
    }
}
