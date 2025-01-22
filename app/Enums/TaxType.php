<?php

namespace App\Enums;

enum TaxType: int
{
    case EXEMPT = 0;
    case VATABLE = 1;

    public function label(): string
    {
        return match ($this) {
            self::EXEMPT => __('Bebas Pajak'),
            self::VATABLE => __('PPN'),
        };
    }
}
