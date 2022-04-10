<?php

namespace App\Http\Controllers;

use App\Http\Resources\SimpleResource;
use App\Models\Product;
use App\Models\ShipmentCost;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function actionCalcSellingPrice(Request $request)
    {
        $productId = (int)$request->get('product');
        $shipmentCost = ShipmentCost::getActive();

        if (empty($productId)) {
            return SimpleResource::make([
                'selling_price' => 0
            ]);
        }

        $product = Product::query()->find($productId);
        $quantity = (int)$request->get('quantity');
        $unitCost = (float)$request->get('unit_cost');
        $unitCost = money($unitCost * 100);

        $sellingPrice = \App\Models\Sale::calcSellingPrice(
            $quantity,
            $unitCost,
            $product,
            $shipmentCost
        );

        return SimpleResource::make([
            'selling_price' => $sellingPrice->format()
        ]);
    }
}
