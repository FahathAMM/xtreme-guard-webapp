<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVideo extends Model
{
    use HasFactory;

    protected $table = 'product_videos';

    protected $fillable = [
        'product_id',
        'file_name',
        'link',
        'path',
        'desc',
    ];

    /**
     * Get the product that owns the attachment.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
