<?php

namespace App\Enums;

enum UserLimit
{
	case FREE;
	case PAID;
	case UNLIMIT;

    public static function free(self $limit): int
    {
        return match ($limit) {
            self::FREE => 3,
        };
    }

    public static function paid(self $limit): int
    {
        return match ($limit) {
            self::PAID => 10,
        };
    }

    public static function unlimit(self $limit): int
    {
        return match ($limit) {
            self::UNLIMIT => 1000,
        };
    }
}
