<?php

namespace App\Models;

use App\Observers\ShipmentCostObserver;
use Cknow\Money\Casts\MoneyIntegerCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property \Cknow\Money\Money $cost
 * @property boolean $is_active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Illuminate\Support\Collection|\App\Models\Sale[] $sales
 */
class ShipmentCost extends Model
{
    use HasFactory;

    protected $casts = [
        'cost' => MoneyIntegerCast::class,
        'is_active' => 'bool',
    ];

    protected $fillable = [
        'cost',
    ];

    protected static function booted()
    {
        self::observe(ShipmentCostObserver::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public static function getActive()
    {
        return self::query()
            ->where('is_active', true)
            ->orderByDesc('created_at')
            ->firstOrFail();
    }
}
