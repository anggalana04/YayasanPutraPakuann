<?php
// app/Models/PpdbManagementPhase.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpdbManagementPhase extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'phase_name',
        'start_date',
        'end_date',
        'status',
        'is_live',
        'wa_group_link',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_live' => 'boolean',
    ];

    public function school()
    {
        return $this->belongsTo(\App\Models\School::class);
    }
}
