<?php

declare(strict_types=1);

namespace App\Factory;

use App\Model\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Psr\Container\ContainerInterface;

class TaskRepositoryFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     * @return \App\Repository\TaskRepository
     */
    public function __invoke(ContainerInterface $container): TaskRepository
    {
        /**
         * @var EntityManagerInterface $em
         * @var EntityRepository $repository
         */
        $em = $container->get(EntityManagerInterface::class);
        $repository =  $em->getRepository(Task::class);

        return new TaskRepository($em, $repository);
    }
}
