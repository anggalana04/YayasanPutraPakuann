<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class SmkJurusan extends Model
{
    protected $table = 'smk_jurusans';

    protected $fillable = [
        'school_id',
        'name',
        'short_name',
        'slug',
        'tagline',
        'description',
        'content',
        'cover_image_url',
        'icon',
        'accent_color',
        'order_column',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order_column' => 'integer',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order_column')->orderBy('id');
    }

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }
}
