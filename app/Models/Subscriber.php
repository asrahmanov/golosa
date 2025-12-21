<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'ip_address',
        'source',
        'is_notified',
    ];

    protected $casts = [
        'is_notified' => 'boolean',
    ];
}




