<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\User;
use App\Input\UserInput;
use App\Service\UserService;
use TheCodingMachine\GraphQLite\Annotations\Query;
use TheCodingMachine\GraphQLite\Annotations\Mutation;
use TheCodingMachine\GraphQLite\Annotations\UseInputType;

class UserController extends AbstractController
{
    /**
     * @param \App\Service\UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @Mutation
     * @UseInputType(for="$userInput", inputType="CreateUserInput!")
     * @param \App\Input\UserInput $userInput
     * @return \App\Model\User
     * @throws \TheCodingMachine\GraphQLite\Exceptions\GraphQLAggregateException
     * @throws \TheCodingMachine\GraphQLite\Exceptions\GraphQLException
     */
    public function createUser(UserInput $userInput): User
    {
        $this->validate($userInput);
        return $this->process(
            function () use ($userInput) {
                return $this->service->create($userInput);
            }
        );
    }

    /**
     * @Mutation
     * @UseInputType(for="$userInput", inputType="EditUserInput!")
     * @param \App\Input\UserInput $userInput
     * @return \App\Model\User
     * @throws \TheCodingMachine\GraphQLite\Exceptions\GraphQLAggregateException
     * @throws \TheCodingMachine\GraphQLite\Exceptions\GraphQLException
     */
    public function editUser(UserInput $userInput): User
    {
        $this->validate($userInput);
        return $this->process(
            function () use ($userInput) {
                return $this->service->edit($userInput);
            }
        );
    }

    /**
     * @Mutation
     * @UseInputType(for="$userInput", inputType="DeleteUserInput!")
     * @param \App\Input\UserInput $userInput
     * @return bool
     * @throws \TheCodingMachine\GraphQLite\Exceptions\GraphQLException
     */
    public function deleteUser(UserInput $userInput): bool
    {
        return $this->process(
            function () use ($userInput) {
                return $this->service->delete($userInput);
            }
        );
    }
}
