<?php

declare(strict_types=1);

namespace App\Factory;

use App\Validator\UserValidator;
use App\Repository\UserRepository;
use App\Service\UserService;
use Psr\Container\ContainerInterface;

class UserServiceFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     * @return \App\Service\UserService
     */
    public function __invoke(ContainerInterface $container): UserService
    {
        return new UserService(
            $container->get(UserValidator::class),
            $container->get(UserRepository::class)
        );
    }
}
