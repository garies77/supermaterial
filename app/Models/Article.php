<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'content',
        'featured_image',
        'excerpt',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_published',
        'is_fullwidth',
        'published_at',
        'footer_script',
        'header_script',
    ];
    
    protected $casts = [
        'is_published' => 'boolean',
        'is_fullwidth' => 'boolean',
        'published_at' => 'datetime',
    ];
    
    /**
     * Get the category that owns the article.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
