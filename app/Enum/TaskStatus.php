<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

final class TaskStatus extends Enum
{
    public const TO_DO = 1;
    public const DOING = 2;
    public const DONE = 3;
}
