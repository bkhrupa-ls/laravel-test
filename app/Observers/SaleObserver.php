<?php

namespace App\Observers;

use App\Models\Sale;
use App\Models\ShipmentCost;

class SaleObserver
{

    public function creating(Sale $sale)
    {
        /** @var \App\Models\ShipmentCost $shipmentCost */
        $shipmentCost = ShipmentCost::getActive();

        $sale->selling_price = Sale::calcSellingPrice(
            $sale->quantity,
            $sale->unit_cost,
            $sale->product,
            $shipmentCost
        );

        $sale->shipment_cost_id = $shipmentCost->id;
    }
}
