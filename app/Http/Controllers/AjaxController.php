<?php

namespace App\Http\Controllers;

use App\Http\Resources\SimpleResource;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function actionCalcSellingPrice(Request $request)
    {
        $quantity = (int)$request->get('quantity');
        $unitCost = (float)$request->get('unit_cost');
        $unitCost = money($unitCost * 100);

        $sellingPrice = \App\Models\Sale::calcSellingPrice($quantity, $unitCost);

        return SimpleResource::make([
            'selling_price' => $sellingPrice->format()
        ]);
    }
}
