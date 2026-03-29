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
    public function isSuperAdmin(): bool
    {
        return $this->is_admin && $this->admin_role === 'superadmin';
    }
    public function isSdAdmin(): bool
    {
        return $this->is_admin && $this->admin_role === 'sd_admin';
    }
    public function isSmpAdmin(): bool
    {
        return $this->is_admin && $this->admin_role === 'smp_admin';
    }
    public function isSmkAdmin(): bool
    {
        return $this->is_admin && $this->admin_role === 'smk_admin';
    }

    /** School slug used in PPDB/management URLs, e.g. smk-putra-pakuan */
    public function getSchoolSlug(): string
    {
        return [
            'smk_admin' => 'smk-putra-pakuan',
            'smp_admin' => 'smp-putra-pakuan',
            'sd_admin'  => 'sdit-putra-pakuan',
        ][$this->admin_role] ?? '';
    }

    /** Short school type used in CMS URLs: smk | smp | sd */
    public function getCmsType(): string
    {
        return [
            'smk_admin' => 'smk',
            'smp_admin' => 'smp',
            'sd_admin'  => 'sd',
        ][$this->admin_role] ?? '';
    }

    /** Human-readable role label */
    public function getRoleLabel(): string
    {
        return [
            'superadmin' => 'Superadmin',
            'smk_admin'  => 'Admin SMK',
            'smp_admin'  => 'Admin SMP',
            'sd_admin'   => 'Admin SD/SDIT',
        ][$this->admin_role] ?? ucfirst($this->admin_role ?? 'Admin');
    }
}
