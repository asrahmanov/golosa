<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Narrator extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'title',
        'bio',
        'photo',
    ];

    public function tales(): HasMany
    {
        return $this->hasMany(Tale::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}


