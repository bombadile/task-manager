<?php

declare(strict_types=1);

namespace App\Factory;

use App\Repository\TaskRepository;
use App\Validator\TaskValidator;
use Psr\Container\ContainerInterface;

class TaskValidatorFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     * @return \App\Validator\TaskValidator
     */
    public function __invoke(ContainerInterface $container): TaskValidator
    {
        return new TaskValidator($container->get(TaskRepository::class));
    }
}
