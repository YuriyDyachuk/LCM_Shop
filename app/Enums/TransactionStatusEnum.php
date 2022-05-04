<?php

declare(strict_types=1);

namespace App\Enums;

use Spatie\Enum\Enum;

/**
* @method static self completed()
* @method static self pending()
* @method static self cansel()
* @method static self onHold()
*/
class TransactionStatusEnum extends Enum
{
    public static function values(): array
    {
        return [
            'completed' => 1,
            'pending' => 2,
            'cansel' => 3,
            'onHold' => 4
        ];
    }
}