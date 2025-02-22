<?php

namespace App\Enums;

enum PaymentType: string
{
    case TUNAI = 'tunai';

    case QRIS = 'qris';
}
