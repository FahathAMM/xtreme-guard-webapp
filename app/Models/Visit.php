<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip',
        'user_agent',
        'visited_at',
    ];

    // If you want to treat 'visited_at' as a Carbon date automatically
    protected $dates = [
        'visited_at',
    ];
}
