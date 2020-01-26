<?php

declare(strict_types=1);

namespace App\Factory;

use App\Model\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Psr\Container\ContainerInterface;

class UserRepositoryFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     * @return \App\Repository\UserRepository
     */
    public function __invoke(ContainerInterface $container): UserRepository
    {
        /**
         * @var EntityManagerInterface $em
         * @var EntityRepository $repository
         */
        $em = $container->get(EntityManagerInterface::class);
        $repository =  $em->getRepository(User::class);

        return new UserRepository($em, $repository);
    }
}
