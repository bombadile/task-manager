<?php

declare(strict_types=1);

namespace App\Input;

use TheCodingMachine\GraphQLite\Annotations\Type;
use TheCodingMachine\GraphQLite\Annotations\Field;

/**
 * @Type()
 */
class TaskSortInput extends AbstractInput
{
    private string $field;

    private string $direction;

    /**
     * @Field()
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @Field()
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    /**
     * @param string $field
     * @return TaskSortInput
     */
    public function setField(string $field): TaskSortInput
    {
        $this->field = $field;
        return $this;
    }

    /**
     * @param string $direction
     * @return TaskSortInput
     */
    public function setDirection(string $direction): TaskSortInput
    {
        $this->direction = $direction;
        return $this;
    }
}
