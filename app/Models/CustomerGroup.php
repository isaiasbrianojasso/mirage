<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'discount_percentage',
        'show_taxes',
        'show_prices',
    ];

    protected $casts = [
        'discount_percentage' => 'decimal:2',
        'show_taxes' => 'boolean',
        'show_prices' => 'boolean',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
