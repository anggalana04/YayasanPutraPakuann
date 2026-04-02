<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'school_id',
        'ppdb_application_id',
        'nis',
        'full_name',
        'email',
        'phone',
        'date_of_birth',
        'place_of_birth',
        'gender',
        'address',
        'nisn',
        'previous_school',
        'academic_year_entry',
        'major',
        'current_class',
        'class_room',
        'father_name',
        'father_occupation',
        'mother_name',
        'mother_occupation',
        'parent_salary_range',
        'enrollment_status',
        'enrolled_at',
        'graduated_at',
        'dropped_at',
        'notes',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'enrolled_at'   => 'date',
        'graduated_at'  => 'date',
        'dropped_at'    => 'date',
    ];

    // ── Relationships ───────────────────────────────────────────────────────────

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function ppdbApplication(): BelongsTo
    {
        return $this->belongsTo(PpdbApplication::class);
    }

    // ── Accessors ───────────────────────────────────────────────────────────────

    /** Returns the public URL to the student photo (from PPDB berkas or null). */
    public function getPhotoUrlAttribute(): ?string
    {
        $file = $this->ppdbApplication?->photo_file;
        if (!$file) {
            return null;
        }
        return \Illuminate\Support\Facades\Storage::url($file);
    }

    /** First letter of name for avatar fallbacks. */
    public function getInitialAttribute(): string
    {
        return strtoupper(mb_substr($this->full_name, 0, 1));
    }

    /** Formatted class display, e.g. "X TKR A" */
    public function getClassLabelAttribute(): string
    {
        return trim(implode(' ', array_filter([
            $this->current_class,
            $this->major,
            $this->class_room,
        ])));
    }

    // ── Scopes ──────────────────────────────────────────────────────────────────

    public function scopeForYear($query, string $year)
    {
        return $query->where('academic_year_entry', $year);
    }

    public function scopeForMajor($query, string $major)
    {
        return $query->where('major', $major);
    }

    public function scopeActive($query)
    {
        return $query->where('enrollment_status', 'active');
    }

    public function scopeForSchool($query, int $schoolId)
    {
        return $query->where('school_id', $schoolId);
    }

    // ── Helpers ─────────────────────────────────────────────────────────────────

    public static function getSmkMajors(): array
    {
        return ['MPLB', 'AKL', 'TKJ', 'DKV', 'TKR', 'TSM'];
    }

    public static function getStatusLabel(string $status): string
    {
        return match ($status) {
            'active'      => 'Aktif',
            'graduated'   => 'Lulus',
            'dropped'     => 'Keluar',
            'transferred' => 'Pindah',
            default       => ucfirst($status),
        };
    }

    public static function getStatusColor(string $status): string
    {
        return match ($status) {
            'active'      => 'green',
            'graduated'   => 'blue',
            'dropped'     => 'red',
            'transferred' => 'orange',
            default       => 'gray',
        };
    }
}
