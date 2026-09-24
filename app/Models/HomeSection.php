<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    use HasFactory;

    protected $table = 'home_sections';

    protected $fillable = [
        'section_key',
        'section_name',
        'tagline',
        'title',
        'subtitle',
        'description',
        'button_text',
        'button_url',
        'image_path',
        'extra_image_path',
        'content_json',
        'is_visible',
        'sort_order',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'content_json' => 'array',
        'sort_order' => 'integer',
    ];

    public static function getByKey($key)
    {
        return static::where('section_key', $key)->first();
    }
}
