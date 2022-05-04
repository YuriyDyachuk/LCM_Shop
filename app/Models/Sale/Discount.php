<?php

namespace App\Models\Sale;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Discount
 * @package App\Models\Sale
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $typeName
 * @property array $rule
 * @property array $ruleApply
 * @property int $priority
 * @property bool $is_active
 * @property DiscountProduct[] $applyProducts
 * @property string $product_apply_type
 *
 */
class Discount extends Model
{
    use HasFactory;

    public const PRIORITY_DEFAULT = 1;

    public const TYPE_CODE_PRODUCT_PRICE_PERCENTAGE = 'product_price_percentage';
    public const TYPE_CODE_PRODUCT_PRICE_FIXED = 'product_price_fixed';
    public const TYPE_CODE_PRODUCT_QUANTITY_BASED = 'product_quantity_based';

    public const TYPE_NAMES = [
        self::TYPE_CODE_PRODUCT_PRICE_PERCENTAGE => 'Percentage of product price',
        self::TYPE_CODE_PRODUCT_PRICE_FIXED => 'Fixed product price',
        self::TYPE_CODE_PRODUCT_QUANTITY_BASED => 'Quantity based discount',
    ];

    public const PRODUCT_APPLY_TYPE_ALL_PRODUCT = 'all_product';
    public const PRODUCT_APPLY_TYPE_PRODUCT_SEVERAL = 'product_several';

    public const PRODUCT_APPLY_TYPE_NAMES = [
        self::PRODUCT_APPLY_TYPE_ALL_PRODUCT => 'All product',
        self::PRODUCT_APPLY_TYPE_PRODUCT_SEVERAL => 'Several product'
    ];

    protected $fillable = [
        'name',
        'product_apply_type',
        'type',
        'priority',
        'is_active',
    ];

    protected $casts = [
        'rule' => 'array',
    ];

    public function getTypeNameAttribute(): string
    {
        return self::TYPE_NAMES[$this->type];
    }

    public function getRuleApplyAttribute(): array
    {
        if (empty($this->rule[$this->type]))
        {
            return [];
        }

        return $this->rule;
    }

    public function applyProducts()
    {
        return $this->hasMany(DiscountProduct::class);
    }


}
