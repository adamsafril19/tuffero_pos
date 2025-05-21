<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleShipment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function getShippingCostAttribute($value)
    {
        return $value / 100;
    }

    public function setShippingCostAttribute($value)
    {
        $this->attributes['shipping_cost'] = $value * 100;
    }
}
