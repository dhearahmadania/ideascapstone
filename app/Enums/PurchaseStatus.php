<?php

namespace App\Enums;

enum PurchaseStatus: int
{
    case PENDING = 0;
    case APPROVED = 1;

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Tertunda',
            self::APPROVED => 'Disetujui',
        };
    }

    // Tambahkan fungsi untuk mendapatkan semua status
    public static function all(): array
    {
        return [
            self::PENDING->value => self::PENDING->label(),
            self::APPROVED->value => self::APPROVED->label(),
        ];
    }
}
