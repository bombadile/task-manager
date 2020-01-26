<?php

declare(strict_types=1);

namespace App\Input;

use TheCodingMachine\GraphQLite\Annotations\Type;
use TheCodingMachine\GraphQLite\Annotations\Field;

/**
 * @Type()
 */
class UserInput extends AbstractInput
{
    private ?int $id = null;

    private ?string $name = null;

    private ?string $email = null;

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
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @Field()
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $email
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @Field()
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }
}
