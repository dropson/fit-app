<?php

declare(strict_types=1);

namespace App\Enums;

enum UserRoleEnum: string
{
    case MODERATOR = 'moderator';
    case COACH = 'coach';
    case CLIENT = 'client';

}
