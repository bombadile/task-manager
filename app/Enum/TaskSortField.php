<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

final class TaskSortField extends Enum
{
    public const ID = "id";
    public const DUE_DATE = "dueDate";
    public const STATUS = "status";
    public const TITLE = "title";
}
