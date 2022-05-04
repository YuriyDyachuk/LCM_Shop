<?php

declare(strict_types=1);

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self published()
 * @method static self not_published()
 */
class BillingStatusEnum extends Enum
{
    public static function values(): array
    {
        return [
            'published' => '0',
            'not_published' => '1'
        ];
    }
}