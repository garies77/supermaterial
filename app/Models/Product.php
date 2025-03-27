<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'is_active',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'tokopedia_link',
        'shopee_link',
        'short_description',
    ];
    
    /**
     * Get the category that owns the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
    /**
     * Get the images for the product.
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Get the first image of the product.
     * 
     * @return string|null
     */
    public function getImageAttribute()
    {
        $firstImage = $this->images()->first();
        return $firstImage ? $firstImage->image : null;
    }
    
    /**
     * Get the featured image of the product.
     * 
     * @return string|null
     */
    public function getFeaturedImageAttribute()
    {
        $featuredImage = $this->images()->where('is_primary', true)->first();
        return $featuredImage ? $featuredImage->image_path : $this->image_path;  
    }
}
