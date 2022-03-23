<?php

namespace App\Enums;

enum UserAccount: string
{
	case FREE = 'free';
	case PAID = 'paid';
	case UNLIMIT = 'unlimit';
}
