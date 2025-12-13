<?php

namespace App\Models\Category;

use App\Helpers\Media;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use Media;

    protected $fillable = [
        'name',
        'slug',
        'img',
        'is_active',
        'description',
        'parent_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (empty($model->slug)) {

                $parentSlug = Category::find($model->parent_id)->slug ?? false;

                if ($parentSlug) {
                    $model->slug = Str::slug($parentSlug . ' ' . $model->name);
                } else {
                    $model->slug = Str::slug($model->name);
                }
            }
        });

        // For update only (before updating in the database)
        static::updating(function ($model) {
            // You can check if name or parent_id changed to regenerate slug
            if ($model->isDirty(['name', 'parent_id'])) {
                $parentSlug = Category::find($model->parent_id)->slug ?? false;

                if ($parentSlug) {
                    $model->slug = Str::slug($parentSlug . ' ' . $model->name);
                } else {
                    $model->slug = Str::slug($model->name);
                }
            }
        });
    }

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('subcategories');
    }

    public function parentCategories()
    {
        return $this->belongsTo(Category::class, 'parent_id')->with('subcategories');
    }

    // public function setNameAttribute($value)
    // {
    //     $this->attributes['name'] = $value;
    //     $this->attributes['slug'] = Str::slug($value);
    // }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImgAttribute($value)
    {
        // Define the default image URL
        $defaultImage = 'https://www.hikvision.com/content/dam/hikvision/en/marketing/image/products/video-intercom-products/homepage/Video-Intercom_Homepage_product_IP.png.thumb.1280.1280.png';

        // Check if the value is empty
        if (!$value) {
            return $defaultImage;
        }

        // Check if the file exists in storage
        if (Storage::exists('public/' . $value)) {
            return asset('storage/' . $value);
        } else {
            return $defaultImage;
        }
    }
}
