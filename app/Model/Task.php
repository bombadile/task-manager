<?php

namespace App\Model;

use App\Enum\TaskStatus;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use TheCodingMachine\GraphQLite\Annotations\Type;
use TheCodingMachine\GraphQLite\Annotations\Field;

/**
 * @Type()
 * @ORM\Entity
 * @ORM\Table(name="task")
 */
class Task extends AbstractModel
{
    /**
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description;

    /**
     * @ORM\Column(type="datetime_immutable", name="due_date", nullable=true)
     */
    private ?\DateTimeImmutable $dueDate;

    /**
     * @ORM\Column(type="integer", columnDefinition="SMALLINT(2) NOT NULL DEFAULT 1")
     */
    private int $status;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="tasks")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private ?User $user;

    /**
     * @param string $title
     * @param string|null $description
     * @param \DateTimeImmutable|null $dueDate
     */
    public function __construct(string $title, ?string $description = null, ?\DateTimeImmutable $dueDate = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->dueDate = $dueDate;
        $this->status = TaskStatus::TO_DO;
    }

    /**
     * @param string $title
     * @param string|null $description
     * @param \DateTimeImmutable|null $dueDate
     */
    public function edit(string $title, ?string $description = null, ?\DateTimeImmutable $dueDate = null): void
    {
        $this->title = $title;
        $this->description = $description;
        $this->dueDate = $dueDate;
    }

    /**
     * @param int $status
     */
    public function changeStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @param \App\Model\User $user
     */
    public function attachUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     *
     */
    public function detachUser(): void
    {
        $this->user = null;
    }

    /**
     * @Field()
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @Field()
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @Field()
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @Field()
     * @return \DateTimeImmutable|null
     */
    public function getDueDate(): ?\DateTimeImmutable
    {
        return $this->dueDate;
    }

    /**
     * @Field()
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @Field()
     * @return string
     */
    public function getStatusEnum(): string
    {
        /**
         * @TODO uncomment this when will be fixed the bug:
         * https://github.com/thecodingmachine/graphqlite/issues/227
         */
        //return new TaskStatus($this->status);


        return (new TaskStatus($this->status))->getKey();
    }

    /**
     * @Field()
     * @return \App\Model\User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @return bool
     */
    public function hasUser(): bool
    {
        return ($this->user !== null);
    }
}
