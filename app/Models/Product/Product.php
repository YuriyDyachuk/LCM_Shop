<?php

namespace App\Models\Product;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Models\Product
 *
 * @property int $id
 * @property int $category_id
 * @property ProductCategory $category
 * @property string $name
 * @property string $sku
 * @property float $price
 * @property int $quantity
 * @property bool $in_stock
 * @property string $description
 * @property bool $is_active
 * @property bool $is_virtual
 * @property ProductSeo|null $seo
 *
 */
class Product extends Model
{
    use HasFactory;
//    use UploadTrait;

    protected $fillable = [
        'category_id',
        'name',
        'sku',
        'price',
        'quantity',
        'in_stock',
        'description',
        'is_active',
        'is_virtual',
    ];

    private const UPLOAD_FOLDER_NAME = 'products';

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function seo()
    {
        return $this->hasOne(ProductSeo::class)->withDefault();
    }

    public function category()
    {
        return $this->hasOne(ProductCategory::class, 'id', 'category_id')->withDefault();
    }

    public static function uploadPath(): string
    {
        return config('filesystems.uploadFolderName') . DIRECTORY_SEPARATOR . self::UPLOAD_FOLDER_NAME;
    }
}
