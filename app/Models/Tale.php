<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tale extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'moral',
        'content',
        'audio_url',
        'cover_image',
        'duration',
        'region_id',
        'narrator_id',
        'listens',
        'is_featured',
        'is_published',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function narrator(): BelongsTo
    {
        return $this->belongsTo(Narrator::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getDurationFormattedAttribute(): string
    {
        $minutes = floor($this->duration / 60);
        $seconds = $this->duration % 60;
        return sprintf('%d:%02d', $minutes, $seconds);
    }
}




