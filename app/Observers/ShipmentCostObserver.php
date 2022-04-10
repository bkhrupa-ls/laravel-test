<?php

namespace App\Observers;

use App\Models\ShipmentCost;

class ShipmentCostObserver
{

    public function creating(ShipmentCost $shipmentCost)
    {
        ShipmentCost::query()->update(['is_active' => false]);

        $shipmentCost->is_active = true;
    }
}
