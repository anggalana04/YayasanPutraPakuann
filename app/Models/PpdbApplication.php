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
        'raport_file',
        'prestasi_file',
        'last_registration_step',
        'place_of_birth',
        'gender',
    ];

    protected $hidden = [
        'password',
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
        return in_array($this->status, ['payment_uploaded', 'payment_completed', 'verified', 'accepted']);
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
