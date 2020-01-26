<?php

declare(strict_types=1);

namespace App\Factory;

use App\Input\UserInput;
use App\Repository\UserRepository;
use Psr\Container\ContainerInterface;
use TheCodingMachine\GraphQLite\Annotations\Factory;

class UserInputFactory
{
    /**
     * @Factory(name="CreateUserInput", default=false)
     * @param string $name
     * @param string $email
     * @return \App\Input\UserInput
     */
    public function createUser(string $name, string $email): UserInput
    {
        return (new UserInput())->setName($name)->setEmail($email);
    }

    /**
     * @Factory(name="EditUserInput", default=false)
     * @param int $id
     * @param string $name
     * @return \App\Input\UserInput
     */
    public function editUser(int $id, string $name): UserInput
    {
        return (new UserInput())->setId($id)->setName($name);
    }

    /**
     * @Factory(name="DeleteUserInput", default=false)
     * @param int $id
     * @return \App\Input\UserInput
     */
    public function deleteUser(int $id): UserInput
    {
        return (new UserInput())->setId($id);
    }
}
