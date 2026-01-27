<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cafe extends Model
{
    /** @use HasFactory<\Database\Factories\CafeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'address',
        'google_maps_url',
        'whatsapp_number',
        'tagline',
        'instagram_url',
        'tiktok_url',
        'established_year',
        'has_wifi',
        'rating',
        'image_path',
        'menu_image_path',
        'images',
        'latitude',
        'longitude',
        'opening_time',
        'closing_time',
        'owner_id',
        'total_energy',
        'status',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function reactions()
    {
        return $this->hasMany(CafeReaction::class);
    }

    /**
     * Get the menus for the cafe.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Menu, $this>
     */
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    /**
     * Get the reviews for the cafe.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Review, $this>
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'cafe_facility');
    }

    /**
     * Check if the cafe is currently open.
     */
    public function getIsOpenAttribute(): bool
    {
        if (! $this->opening_time || ! $this->closing_time) {
            return false;
        }

        $now = now()->format('H:i:s');

        // Handle overnight hours (e.g., 18:00 - 02:00)
        if ($this->closing_time < $this->opening_time) {
            return $now >= $this->opening_time || $now <= $this->closing_time;
        }

        return $now >= $this->opening_time && $now <= $this->closing_time;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'images' => 'array',
            'has_wifi' => 'boolean',
            'rating' => 'decimal:2',
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
        ];
    }
}
