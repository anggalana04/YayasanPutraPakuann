<?php

namespace App\Models;

use App\Models\PpdbApplication;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpdbMajorCapacity extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'year',
        'major',
        'capacity',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function getRemainingAttribute()
    {
        $count = PpdbApplication::where('school_id', $this->school_id)
            ->where('assigned_major', $this->major)
            ->where('status', 'accepted')
            ->whereYear('created_at', intval(substr($this->year, 0, 4)))
            ->count();

        return max(0, $this->capacity - $count);
    }
}
