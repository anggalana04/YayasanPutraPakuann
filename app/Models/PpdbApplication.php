<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\School;

class PpdbApplication extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'application_id',
        'unique_code',
        'login_token',
        'school_id',
        'password',
        'full_name',
        'email',
        'phone',
        'date_of_birth',
        'address',
        'previous_school',
        'nisn',
        'status',
        'status_history',
        'uploaded_documents',
        'payment_amount',
        'payment_method',
        'payment_proof',
        'payment_date',
        'admission_date',
        'father_name',
        'father_occupation',
        'mother_name',
        'mother_occupation',
        'parent_salary_range',
        'major_1',
        'major_2',
        'assigned_major',
        'kk_file',
        'ijazah_file',
        'photo_file',
        'akta_kelahiran_file',
        'prestasi_file',
        'last_registration_step',
        'place_of_birth',
        'gender',
    ];

    protected $hidden = [
        'password',
        'unique_code',
        'login_token',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'payment_date' => 'datetime',
        'admission_date' => 'datetime',
        'status_history' => 'array',
        'uploaded_documents' => 'array',
        'payment_amount' => 'decimal:2',
    ];

    // ── Relationships ─────────────────────────────────────────────────

    public function school(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    /**
     * Virtual accessor so existing code reading $app->school_type continues to work.
     * Avoids mass-updating every read reference while keeping a single source of truth.
     */
    public function getSchoolTypeAttribute(): string
    {
        return $this->school?->type ?? '';
    }

    public function student(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Student::class, 'ppdb_application_id');
    }

    // Authentication methods
    public function getAuthIdentifierName()
    {
        return 'application_id';
    }

    public function getAuthIdentifier()
    {
        return $this->application_id;
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    // Helper methods
    public function generateApplicationId()
    {
        $year = date('Y');
        $count = self::where('school_id', $this->school_id)
            ->whereYear('created_at', $year)
            ->count() + 1;

        return 'PPDB-' . $year . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Generate a secure random login token (format: PPDB-XXXX-XXXX).
     * Uses alphanumeric characters for strong randomness.
     */
    public static function generateLoginToken(): string
    {
        do {
            $part1 = strtoupper(\Illuminate\Support\Str::random(4));
            $part2 = strtoupper(\Illuminate\Support\Str::random(4));
            $token = 'PPDB-' . $part1 . '-' . $part2;
        } while (self::where('login_token', $token)->exists());

        return $token;
    }

    /**
     * Generate a unique 8-char alphanumeric code for applicant login.
     * Uses unambiguous characters (no 0/O/1/I/L).
     */
    public static function generateUniqueCode(): string
    {
        $chars = 'ABCDEFGHJKMNPQRSTVWXYZ23456789';
        do {
            $code = '';
            for ($i = 0; $i < 8; $i++) {
                $code .= $chars[random_int(0, strlen($chars) - 1)];
            }
            // Format as XXXX-XXXX for readability
            $formatted = substr($code, 0, 4) . '-' . substr($code, 4, 4);
        } while (self::where('unique_code', $formatted)->exists());

        return $formatted;
    }

    public function setPasswordFromDob(): void
    {
        // Always hash the generated password — storing plain-text passwords is forbidden.
        $this->password = bcrypt($this->date_of_birth->format('dmY'));
    }

    public function updateStatus($newStatus, $notes = null)
    {
        $history = $this->status_history ?? [];
        $history[] = [
            'status' => $newStatus,
            'changed_at' => now(),
            'notes' => $notes,
        ];

        $this->update([
            'status' => $newStatus,
            'status_history' => $history,
        ]);
    }

    // Status helpers
    public function isDraft()
    {
        return $this->status === 'draft';
    }

    public static function cleanupOldDrafts(): int
    {
        return self::where('status', 'draft')
            ->where('updated_at', '<', now()->subWeek())
            ->delete();
    }

    public function isCompleted()
    {
        return in_array($this->status, ['payment_uploaded', 'payment_confirmed', 'payment_completed', 'verified', 'accepted']);
    }

    public function canLogin()
    {
        // Allow all applicants to log in so they can continue, complete, or check status.
        // If additional block rules are needed later, add them explicitly.
        return true;
    }

    public function getProfilePhotoUrlAttribute()
    {
        if ($this->photo_file) {
            // Assume photo_file is stored in storage/app/public/...
            // Use Laravel's asset helper to generate the public URL
            return asset('storage/' . ltrim($this->photo_file, '/'));
        }
        return asset('images/default-profile.png');
    }
}
