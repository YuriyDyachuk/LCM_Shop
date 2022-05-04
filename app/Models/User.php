<?php

declare(strict_types=1);

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use App\Models\Customer\CustomerAddress;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App\Models
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property string $fullName
 * @property CustomerAddress $address
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    ############################## [CUSTOM METHOD] ##############################

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }


    ############################## [RELATION METHOD] ##############################

    public function address(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(CustomerAddress::class)->withDefault();
    }

    public function checkoutAddress(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CheckoutAddresses::class);
    }

}
