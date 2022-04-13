<?php

namespace App\Enums;

enum UserAccount: string
{
	case FREE = 'free';
	case PAID = 'paid';
	case UNLIMIT = 'unlimit';

    public static function free(self $account): int
    {
        return match ($account) {
            self::FREE => 2,
        };
    }

    public static function paid(self $account): int
    {
        return match ($account) {
            self::PAID => 10,
        };
    }

    public static function unlimit(self $account): int
    {
        return match ($account) {
            self::UNLIMIT => 1000,
        };
    }
}
