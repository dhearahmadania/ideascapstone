<?php

namespace App\Enums;

enum QuotationStatus: int
{
    case PENDING = 0;
    case SENT = 1;
    case CANCELED = 2;

    public function label(): string
    {
        return match ($this) {
            self::PENDING => __('Tertunda'),
            self::SENT => __('Terkirim'),
            self::CANCELED => __('Dibatalkan'),
        };
    }
}
