<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Models\Customer
 *
 * @property int user_id
 * @property string $state_name
 * @property string $city_name
 * @property string $zip_code
 * @property string $address
 *
 */
class CustomerAddress extends Model
{
    use HasFactory;

    public $table = 'user_addresses';

    protected $fillable = [
        'state_name',
        'city_name',
        'zip_code',
        'address'
    ];
}
