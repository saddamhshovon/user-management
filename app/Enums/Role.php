<?php

namespace App\Enums;

use App\Traits\Enumerrayble;

enum Role: string
{
    use Enumerrayble;
    case Admin = 'admin';
    case Moderator = 'moderator';
    case User = 'user';
}
