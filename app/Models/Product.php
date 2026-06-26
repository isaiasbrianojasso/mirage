<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Product extends Model
{
    use HasUuids;

    protected $guarded = [];

    protected $casts = [
        'id' => 'string',
        'specifications' => 'array',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function documents()
    {
        return $this->hasMany(ProductDocument::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Accessor: map 'description' to 'short_description' for backward compatibility.
     */
    public function getDescriptionAttribute(): ?string
    {
        return $this->attributes['short_description'] ?? $this->attributes['long_description'] ?? null;
    }
}
