<?php

declare(strict_types=1);

namespace App\Validator;

use Laminas\Validator\Date;
use Laminas\Validator\StringLength;

class TaskValidator extends AbstractValidator
{
    /**
     * @return array
     */
    protected function rules(): array
    {
        return [
            'title' => [
                new StringLength(['min' => 1, 'max' => 255])
            ],
            'dueDate' => [
                new Date(['format' => 'Y-m-d H:i:s'])
            ],
            'dueDateStart' => [
                new Date(['format' => 'Y-m-d H:i:s'])
            ],
            'dueDateEnd' => [
                new Date(['format' => 'Y-m-d H:i:s'])
            ]
        ];
    }
}
