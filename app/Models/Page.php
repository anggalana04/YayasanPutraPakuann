<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'school_id',
        'title',
        'slug',
        'content',
        'status',
        'meta_title',
        'meta_description',
        'meta_robots',
        'last_updated_by',
        'published_at',
    ];

    protected $dates = [
        'published_at',
        'deleted_at',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
