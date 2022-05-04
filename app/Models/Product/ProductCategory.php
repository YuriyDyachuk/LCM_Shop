<?php

namespace App\Models\Product;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductCategory
 * @package App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property bool $is_active
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $isActiveName
 * @property Product[]|null $products
 *
 */
class ProductCategory extends Model
{
    use HasFactory;

    private const IS_ACTIVE_YES = 1;
    private const IS_ACTIVE_NO = 0;
    private const IS_ACTIVE_YES_NAME = 'active';
    private const IS_ACTIVE_NO_NAME = 'disabled';
    private const IS_ACTIVE_NAMES = [
        self::IS_ACTIVE_YES => self::IS_ACTIVE_YES_NAME,
        self::IS_ACTIVE_NO => self::IS_ACTIVE_NO_NAME
    ];

    protected $fillable = [
        'name',
        'is_active',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function getIsActiveNameAttribute(): string
    {
        return self::IS_ACTIVE_NAMES[$this->is_active];
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
