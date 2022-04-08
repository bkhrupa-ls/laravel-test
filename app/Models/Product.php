<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $profit_margin
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */
class Product extends Model
{
    use HasFactory;

    const CODE_GOLD_COFFEE = 'gold_coffee';
    const PROFIT_MARGIN_GOLD_COFFEE= 25;
    const CODE_ARABIC_COFFEE = 'arabic_coffee';
    const PROFIT_MARGIN_ARABIC_COFFEE = 15;

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
