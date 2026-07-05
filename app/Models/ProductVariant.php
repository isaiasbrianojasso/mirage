<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'sku',
        'price',
        'discount_price',
        'stock',
        'attributes',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'wholesale_price' => 'decimal:2',
        'weight' => 'decimal:2',
        'width' => 'decimal:2',
        'height' => 'decimal:2',
        'depth' => 'decimal:2',
        'additional_shipping_cost' => 'decimal:2',
        'attributes' => 'array',
        'is_active' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
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
