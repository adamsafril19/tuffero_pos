<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleShipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'shipment_number',
        'shipping_method',
        'tracking_number',
        'scheduled_at'
    ];

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
