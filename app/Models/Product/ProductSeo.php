<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductSeo
 * @package App\Models\Product
 *
 * @property int $product_id
 * @property string $title
 * @property string $description
 *
 */
class ProductSeo extends Model
{
    use HasFactory;

    public $table = 'product_seo';

    protected $fillable = [
        'title',
        'description',
    ];
}
