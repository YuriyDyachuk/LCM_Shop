<?php

namespace App\Models\Sale;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PromoCode
 * @package App\Models\Sale
 *
 * @property int $id
 * @property string $code
 * @property int $amount
 * @property string $description
 * @property Carbon $expiry_date_at
 * @property string $expiryDateAtDisplay
 * @property bool $is_active
 * @property string $apply_type
 * @property PromoCodeApplicable[] $applies
 *
 */
class PromoCode extends Model
{
    use HasFactory;

    public const APPLY_TYPE_PRODUCT_ALL = 'product_all';
    public const APPLY_TYPE_PRODUCT_CATEGORIES = 'product_categories';
    public const APPLY_TYPE_PRODUCTS = 'products';

    public const APPLY_TYPE_NAMES = [
        self::APPLY_TYPE_PRODUCT_ALL => 'All products',
        self::APPLY_TYPE_PRODUCT_CATEGORIES => 'Categories',
        self::APPLY_TYPE_PRODUCTS => 'Products'
    ];

    public $table = 'promo_codes';

    protected $fillable = [
        'code',
        'amount',
        'description',
        'expiry_date_at',
        'is_active',
        'apply_type'
    ];

    protected $dates = [
        'expiry_date_at'
    ];

    public function getExpiryDateAtDisplayAttribute(): string
    {
        return empty($this->expiry_date_at) ? '' : $this->expiry_date_at->toDateString();
    }

    public function applies()
    {
        return $this->hasMany(PromoCodeApplicable::class, 'promo_code_id', 'id')->where('applicable_type', $this->apply_type);
    }

}
