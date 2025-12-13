<?php

namespace App\Models\Solution;

use Illuminate\Database\Eloquent\Model;

class SolutionsContent extends Model
{
    protected $table = 'solutions_contents';

    protected $fillable = [
        'solution_id',
        'content',
        'img_width',
        'img_height',
        'cont_orderby',
        'desc',
        'is_published',
    ];

    // Optional: Define timestamps if you're using created_at and updated_at
    public $timestamps = true;

    // Optional: Casts
    protected $casts = [
        'is_published' => 'boolean',
    ];

    // Optional: Define relationship to a Solution model (if exists)
    // public function solution()
    // {
    //     return $this->belongsTo(Solution::class, 'solution_id');
    // }
}
