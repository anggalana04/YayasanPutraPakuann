<?php
// app/Models/School.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'slug',
    ];

    public function homepageSetting()
    {
        return $this->hasOne(SchoolHomepageSetting::class);
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function galleryItems()
    {
        return $this->hasMany(GalleryItem::class);
    }

    public function carouselImages()
    {
        return $this->hasMany(CarouselImage::class);
    }

    public function teacherStaff()
    {
        return $this->hasMany(TeacherStaff::class);
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    /**
     * Maps a URL route slug (e.g. "sd") to the actual DB type (e.g. "SDIT").
     * All lookups on School::where('type', ...) must go through this method.
     */
    public static function resolveDbType(string $slug): string
    {
        return match (strtoupper($slug)) {
            'SD' => 'SDIT',
            default => strtoupper($slug),
        };
    }
}
