<?php

declare(strict_types=1);

namespace App\Input;

use TheCodingMachine\GraphQLite\Annotations\Type;
use TheCodingMachine\GraphQLite\Annotations\Field;

/**
 * @Type()
 */
class TaskInput extends AbstractInput
{
    private ?int $id = null;

    private ?string $title = null;

    private ?string $description = null;

    private ?int $status = null;

    private ?\DateTimeImmutable $dueDate = null;

    private ?int $userId = null;

    /**
     * @param int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @Field()
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param string $title
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @Field()
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $description
     * @return self
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @Field()
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param \DateTimeImmutable|null $dueDate
     * @return self
     */
    public function setDueDate(?\DateTimeImmutable $dueDate): self
    {
        $this->dueDate = $dueDate;
        return $this;
    }

    /**
     * @Field()
     * @return \DateTimeImmutable
     */
    public function getDueDate(): ?\DateTimeImmutable
    {
        return $this->dueDate;
    }

    /**
     * @param int|null $status
     * @return TaskInput
     */
    public function setStatus(?int $status): TaskInput
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int|null $userId
     * @return TaskInput
     */
    public function setUserId(?int $userId): TaskInput
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }
}
