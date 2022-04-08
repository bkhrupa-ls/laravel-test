<?php

namespace App\Observers;

use App\Models\Sale;

class SaleObserver
{

    public function creating(Sale $sale)
    {
        $sale->selling_price = Sale::calcSellingPrice(
            $sale->quantity,
            $sale->unit_cost,
            $sale->product
        );
    }
}
