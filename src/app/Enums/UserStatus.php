<?php

namespace App\Enums;

enum UserStatus: string
{
	case BAN = 'ban';
	case ACTIVE = 'active';
	case UNVERIFIED = 'unverified';
}
