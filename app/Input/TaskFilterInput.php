<?php

declare(strict_types=1);

namespace App\Input;

use TheCodingMachine\GraphQLite\Annotations\Type;
use TheCodingMachine\GraphQLite\Annotations\Field;

/**
 * @Type()
 */
class TaskFilterInput extends AbstractInput
{
    private ?int $limit = null;

    private ?int $offset = null;

    private ?int $status = null;

    private ?\DateTimeImmutable $dueDateStart = null;

    private ?\DateTimeImmutable $dueDateEnd = null;

    private ?int $userId = null;

    /**
     * @Field()
     * @return int|null
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * @Field()
     * @return int|null
     */
    public function getOffset(): ?int
    {
        return $this->offset;
    }

    /**
     * @Field()
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @Field()
     * @return \DateTimeImmutable|null
     */
    public function getDueDateStart(): ?\DateTimeImmutable
    {
        return $this->dueDateStart;
    }

    /**
     * @Field()
     * @return \DateTimeImmutable|null
     */
    public function getDueDateEnd(): ?\DateTimeImmutable
    {
        return $this->dueDateEnd;
    }

    /**
     * @Field()
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @param int|null $limit
     * @return TaskFilterInput
     */
    public function setLimit(?int $limit): TaskFilterInput
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @param int|null $offset
     * @return TaskFilterInput
     */
    public function setOffset(?int $offset): TaskFilterInput
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @param int|null $status
     * @return TaskFilterInput
     */
    public function setStatus(?int $status): TaskFilterInput
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param \DateTimeImmutable|null $dueDateStart
     * @return TaskFilterInput
     */
    public function setDueDateStart(?\DateTimeImmutable $dueDateStart): TaskFilterInput
    {
        $this->dueDateStart = $dueDateStart;
        return $this;
    }

    /**
     * @param \DateTimeImmutable|null $dueDateEnd
     * @return TaskFilterInput
     */
    public function setDueDateEnd(?\DateTimeImmutable $dueDateEnd): TaskFilterInput
    {
        $this->dueDateEnd = $dueDateEnd;
        return $this;
    }

    /**
     * @param int|null $userId
     * @return TaskFilterInput
     */
    public function setUserId(?int $userId): TaskFilterInput
    {
        $this->userId = $userId;
        return $this;
    }
}
