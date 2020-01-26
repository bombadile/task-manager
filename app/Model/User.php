<?php

declare(strict_types=1);

namespace App\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use TheCodingMachine\GraphQLite\Annotations\Type;
use TheCodingMachine\GraphQLite\Annotations\Field;

/**
 * @Type()
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends AbstractModel
{
    /**
     * @var ArrayCollection|Task[]
     * @ORM\OneToMany(targetEntity="Task", mappedBy="user", orphanRemoval=true, cascade={"persist"})
     * @ORM\JoinColumn(name="id", referencedColumnName="user_id", nullable=false, onDelete="CASCADE")
     * @ORM\OrderBy({"dueDate" = "ASC"})
     */
    private $tasks;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private string $email;

    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * @param string $name
     */
    public function edit(string $name): void
    {
        $this->name = $name;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @Field()
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
