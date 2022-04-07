<?php

namespace App\Models;

use App\Observers\SaleObserver;
use Cknow\Money\Casts\MoneyIntegerCast;
use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $quantity
 * @property \Cknow\Money\Money $unit_cost
 * @property \Cknow\Money\Money $selling_price
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */
class Sale extends Model
{
    use HasFactory;

    const PROFIT_MARGIN = 25;

    const SHIPPING_COST = 1000; // 10.00

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

    public static function calcSellingPrice(int $quantity, Money $unitCost): Money
    {
        $cost = $unitCost->multiply($quantity);

        if ($cost->isZero()) {
            return $cost;
        }

        return $cost
            ->multiply(100)
            ->divide(100 - self::PROFIT_MARGIN)
            ->add(money(self::SHIPPING_COST));
    }
}
