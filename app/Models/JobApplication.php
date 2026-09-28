<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $table = 'job_applications';

    protected $fillable = [
        'application_date',
        'name',
        'phone',
        'email',
        'qualification',
        'preferred_sector',
        'preferred_location',
        'job_title',
        'experience',
        'connect_preference',
        'notes',
        'status',
    ];

    protected $casts = [
        'application_date' => 'date',
    ];

    /**
     * Get the formatted display date.
     */
    public function getFormattedDateAttribute(): string
    {
        if ($this->application_date) {
            return $this->application_date->format('d M Y');
        }

        return $this->created_at ? $this->created_at->format('d M Y') : now()->format('d M Y');
    }
}
