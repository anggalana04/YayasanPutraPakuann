<?php
// app/Models/PpdbManagementPhase.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpdbManagementPhase extends Model
{
    use HasFactory;

    protected $fillable = [
        'phase_name',
        'start_date',
        'end_date',
        'status',
    ];
}
