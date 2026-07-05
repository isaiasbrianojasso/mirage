<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Product extends Model
{
    use HasUuids;

    protected $guarded = ['id'];



    protected $casts = [
        'id' => 'string',
        'specifications' => 'array',
        'video_url' => 'string',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'wholesale_price' => 'decimal:2',
        'weight' => 'decimal:2',
        'width' => 'decimal:2',
        'height' => 'decimal:2',
        'depth' => 'decimal:2',
        'additional_shipping_cost' => 'decimal:2',
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

    public function getPriceAttribute($value)
    {
        return $this->applyCustomerGroupDiscount($value);
    }

    public function getDiscountPriceAttribute($value)
    {
        if ($value === null) return null;
        return $this->applyCustomerGroupDiscount($value);
    }

    private function applyCustomerGroupDiscount($price)
    {
        if (!app()->runningInConsole() && request() && !request()->is('admin/*')) {
            if (auth()->check() && auth()->user()->customerGroup && auth()->user()->customerGroup->discount_percentage > 0) {
                return $price * (1 - (auth()->user()->customerGroup->discount_percentage / 100));
            }
        }
        return $price;
    }
}
