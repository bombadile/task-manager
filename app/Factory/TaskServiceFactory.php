<?php

declare(strict_types=1);

namespace App\Factory;

use App\Repository\UserRepository;
use App\Validator\TaskValidator;
use App\Repository\TaskRepository;
use App\Service\TaskService;
use Psr\Container\ContainerInterface;

class TaskServiceFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     * @return \App\Service\TaskService
     */
    public function __invoke(ContainerInterface $container): TaskService
    {
        return new TaskService(
            $container->get(TaskValidator::class),
            $container->get(TaskRepository::class),
            $container->get(UserRepository::class),
        );
    }
}
