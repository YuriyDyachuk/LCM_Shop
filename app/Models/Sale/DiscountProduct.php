<?php

namespace App\Models\Sale;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PromoCodeApply
 * @package App\Models\Sale
 *
 * @property int $id
 * @property int $discount_id
 * @property int $product_id
 *
 */
class DiscountProduct extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'product_id',
    ];



}
