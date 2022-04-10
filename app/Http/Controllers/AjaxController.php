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

        try {
            $shipmentCost = ShipmentCost::getActive();
            $product = Product::query()->findOrFail($productId);
        }
        catch (\Exception $exception) {
            return SimpleResource::make([
                'selling_price' => 0
            ]);
        }

        $quantity = (int)$request->get('quantity');
        $unitCost = toMoney((float)$request->get('unit_cost'));

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
