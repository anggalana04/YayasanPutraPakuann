<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin', // allow mass assignment for admin type
        'admin_role', // for role: superadmin, sd_admin, smp_admin, smk_admin
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    // Helper: check admin role
    public function isSuperAdmin()
    {
        return $this->is_admin && $this->admin_role === 'superadmin';
    }
    public function isSdAdmin()
    {
        return $this->is_admin && $this->admin_role === 'sd_admin';
    }
    public function isSmpAdmin()
    {
        return $this->is_admin && $this->admin_role === 'smp_admin';
    }
    public function isSmkAdmin()
    {
        return $this->is_admin && $this->admin_role === 'smk_admin';
    }
}
