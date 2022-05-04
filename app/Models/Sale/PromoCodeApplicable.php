<?php

namespace App\Models\Sale;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PromoCodeApply
 * @package App\Models\Sale
 *
 * @property int $id
 * @property int $promo_code_id
 * @property string $applicable_type
 * @property int $applicable_id
 *
 */
class PromoCodeApplicable extends Model
{
    use HasFactory;

    public $table = 'promo_code_applies';
    public $timestamps = false;

    protected $fillable = [
        'promo_code_id',
        'applicable_type',
        'applicable_id',
    ];



}
