<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarrierRange extends Model
{
    protected $guarded = ['id'];

    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
    }

    public function zonePrices()
    {
        return $this->hasMany(CarrierZonePrice::class);
    }
}
