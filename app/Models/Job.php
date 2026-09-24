<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Job extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'job_posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'company',
        'sector_slug',
        'sector_name',
        'location',
        'salary',
        'qualification',
        'badge_tag',
        'description',
        'duties',
        'requirements',
        'benefits',
        'contact_email',
        'contact_phone',
        'poster_image',
        'is_active',
        'is_featured',
        'sort_order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($job) {
            if (empty($job->slug)) {
                $job->slug = Str::slug($job->title).'-'.Str::random(5);
            }
        });
    }

    /**
     * Scope for active jobs.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for filtering by search keyword.
     */
    public function scopeSearch($query, $term)
    {
        if (! $term) {
            return $query;
        }

        return $query->where(function ($q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
                ->orWhere('company', 'like', "%{$term}%")
                ->orWhere('location', 'like', "%{$term}%")
                ->orWhere('sector_name', 'like', "%{$term}%")
                ->orWhere('description', 'like', "%{$term}%");
        });
    }

    /**
     * Scope for sector filtering.
     */
    public function scopeSector($query, $sectorSlug)
    {
        if (! $sectorSlug || strtolower($sectorSlug) === 'all') {
            return $query;
        }

        return $query->where('sector_slug', strtolower($sectorSlug));
    }

    /**
     * Get image URL with fallback.
     */
    public function getImageUrlAttribute()
    {
        if (empty($this->poster_image)) {
            return asset('assets/images/roles/overseas_jobs.svg');
        }

        $path = ltrim($this->poster_image, '/');

        if (file_exists(public_path($path))) {
            return asset($path);
        }

        if (str_starts_with($path, 'storage/')) {
            $sub = substr($path, 8);
            if (file_exists(public_path('storage/'.$sub))) {
                return asset('storage/'.$sub);
            }
        }

        return asset($path);
    }
}
