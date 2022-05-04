<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CheckoutAddresses extends Model
{
    use HasFactory;

    public $table = 'checkout_addresses';

    protected $fillable = [
        'billing_status',
        'company_name',
        'first_name',
        'last_name',
        'post_code',
        'address',
        'user_id',
        'country',
        'suite',
        'state',
        'phone',
        'city'
    ];

    protected $casts = [];

}
