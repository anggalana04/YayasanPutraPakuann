<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SchoolHomepageSetting extends Model
{
    protected $table = 'school_homepage_settings';

    protected $fillable = [
        'school_id',
        'kepsek_photo_url',
        'kepsek_name',
        'kepsek_title',
        'kepsek_sambutan',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}

