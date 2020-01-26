<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\User;
use App\Input\UserInput;
use App\Repository\RepositoryInterface;
use App\Validator\ValidatorInterface;

class UserService extends AbstractService
{
    private RepositoryInterface $userRepository;

    /**
     * @param \App\Validator\ValidatorInterface $validator
     * @param \App\Repository\RepositoryInterface $userRepository
     */
    public function __construct(ValidatorInterface $validator, RepositoryInterface $userRepository)
    {
        parent::__construct($validator);
        $this->userRepository = $userRepository;
    }

    /**
     * @param \App\Input\UserInput $userInput
     * @return User
     */
    public function create(UserInput $userInput): User
    {
        $user = new User($userInput->getName(), $userInput->getEmail());
        $this->userRepository->insert($user);
        return $user;
    }

    /**
     * @param \App\Input\UserInput $userInput
     * @return User
     */
    public function edit(UserInput $userInput): User
    {
        /** @var User $user */
        $user = $this->getModel($this->userRepository, $userInput->getId());
        $user->edit($userInput->getName());
        $this->userRepository->edit();
        return $user;
    }

    /**
     * @param \App\Input\UserInput $userInput
     * @return bool
     */
    public function delete(UserInput $userInput): bool
    {
        /** @var User $user */
        $user = $this->getModel($this->userRepository, $userInput->getId());
        $this->userRepository->delete($user);
        return true;
    }
}
