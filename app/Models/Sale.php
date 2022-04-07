<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $quantity
 * @property float $unit_cost
 * @property float $selling_price
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */
class Sale extends Model
{
    use HasFactory;

    const PROFIT_MARGIN = 0.25;

    // pounds
    const SHIPPING_COST = 10;

    protected $casts = [
        'quantity' => 'int',
        'unit_cost' => 'decimal:2',
        'selling_price' => 'decimal:2',
    ];

    public static function calcSellingPrice(int $quantity, float $unitCost): float|int
    {
        $cost = $quantity * $unitCost;

        if ($cost == 0) {
            return 0;
        }

        $sellingPrice = ($cost / (1 - self::PROFIT_MARGIN)) + self::SHIPPING_COST;

        return round($sellingPrice, 2);
    }

    // TODO
//    public function setSellingPriceAttribute($value)
//    {
//
//    }
}
