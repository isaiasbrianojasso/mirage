<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) \Illuminate\Support\Str::uuid();
            }
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function scopeTopLevel($query)
    {
        return $query->whereNull('parent_id');
    }

    public function getRepresentativeImageAttribute()
    {
        if ($this->image) {
            return $this->image;
        }

        // Find a random product with an image in this category or its immediate children
        $categoryIds = $this->children()->pluck('id')->push($this->id)->toArray();
        
        $product = Product::whereIn('category_id', $categoryIds)
            ->whereHas('images')
            ->inRandomOrder()
            ->first();

        if ($product && $product->images->count() > 0) {
            return $product->images->first()->image_url;
        }

        return '/tienda_assets/img/p/mx-default-home_default.jpg';
    }
}
