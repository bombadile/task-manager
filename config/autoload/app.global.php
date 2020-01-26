<?php

use App\Middleware\ErrorHandler\ErrorResponseGeneratorInterface;
use App\Application;
use App\Middleware\ErrorHandler\ErrorHandlerMiddleware;
use App\Middleware\MiddlewareResolver;
use GraphQL\Server\StandardServer;
use GraphQL\Type\Schema;
use PsCs\Middleware\Graphql\WebonyxGraphqlMiddleware;
use Psr\SimpleCache\CacheInterface;
use Psr\Log\LoggerInterface;
use App\Service\UserService;
use App\Validator\UserValidator;
use App\Repository\UserRepository;
use App\Service\TaskService;
use App\Validator\TaskValidator;
use App\Repository\TaskRepository;
use App\Factory;

return [
    'dependencies' => [
        'abstract_factories' => [
            Laminas\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory::class,
        ],
        'factories' => [
            Application::class => Factory\ApplicationFactory::class,
            MiddlewareResolver::class => Factory\MiddlewareResolverFactory::class,
            StandardServer::class => Factory\StandardServerFactory::class,
            CacheInterface::class => Factory\CacheInterfaceFactory::class,
            Schema::class => Factory\SchemaFactory::class,
            WebonyxGraphqlMiddleware::class => Factory\WebonyxGraphqlMiddlewareFactory::class,
            ErrorHandlerMiddleware::class => Factory\ErrorHandlerMiddlewareFactory::class,
            ErrorResponseGeneratorInterface::class => Factory\ErrorResponseGeneratorFactory::class,
            LoggerInterface::class => Factory\LoggerFactory::class,
            UserService::class => Factory\UserServiceFactory::class,
            UserValidator::class => Factory\UserValidatorFactory::class,
            UserRepository::class => Factory\UserRepositoryFactory::class,
            TaskService::class => Factory\TaskServiceFactory::class,
            TaskValidator::class => Factory\TaskValidatorFactory::class,
            TaskRepository::class => Factory\TaskRepositoryFactory::class
        ],
    ],

    'debug' => false,
];
