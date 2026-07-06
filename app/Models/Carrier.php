<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function customerGroups()
    {
        return $this->belongsToMany(CustomerGroup::class, 'carrier_customer_group');
    }

    public function ranges()
    {
        return $this->hasMany(CarrierRange::class);
    }

    public function zonePrices()
    {
        return $this->hasMany(CarrierZonePrice::class);
    }
}
