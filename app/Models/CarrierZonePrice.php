<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CarrierZonePrice extends Pivot
{
    protected $table = 'carrier_zone_price';
    protected $guarded = ['id'];

    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function carrierRange()
    {
        return $this->belongsTo(CarrierRange::class);
    }
}
