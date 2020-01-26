<?php

declare(strict_types=1);

namespace App\Factory;

use App\Repository\UserRepository;
use App\Validator\UserValidator;
use Psr\Container\ContainerInterface;

class UserValidatorFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     * @return \App\Validator\UserValidator
     */
    public function __invoke(ContainerInterface $container): UserValidator
    {
        return new UserValidator($container->get(UserRepository::class));
    }
}
