<?php

namespace App\Enums;

enum SupplierType: string
{
    case DISTRIBUTOR = 'distributor';

    case GROSIR = 'grosir';

    case PRODUCER = 'produsen';

    public function label(): string
    {
        return match ($this) {
            self::DISTRIBUTOR => __('Distributor'),
            self::GROSIR => __('Grosir'),
            self::PRODUCER => __('Produsen'),
        };
    }
}
