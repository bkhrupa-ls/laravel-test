<?php

namespace App\Models;

use App\Observers\SaleObserver;
use Cknow\Money\Casts\MoneyIntegerCast;
use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $shipment_cost_id
 * @property int $quantity
 * @property int $product_id
 * @property \Cknow\Money\Money $unit_cost
 * @property \Cknow\Money\Money $selling_price
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \App\Models\Product $product
 * @property \App\Models\ShipmentCost $shipmentCost
 */
class Sale extends Model
{
    use HasFactory;

    protected $casts = [
        'quantity' => 'int',
        'unit_cost' => MoneyIntegerCast::class,
        'selling_price' => MoneyIntegerCast::class,
    ];

    protected $fillable = [
        'quantity',
        'unit_cost',
    ];

    protected static function booted()
    {
        self::observe(SaleObserver::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function shipmentCost()
    {
        return $this->belongsTo(ShipmentCost::class);
    }

    public static function calcSellingPrice(
        int $quantity,
        Money $unitCost,
        Product $product,
        ShipmentCost $shipmentCost
    ): Money {
        $cost = $unitCost->multiply($quantity);

        if ($cost->isZero()) {
            return $cost;
        }

        return $cost
            ->multiply(100)
            ->divide(100 - $product->profit_margin)
            ->add($shipmentCost->cost);
    }
}
