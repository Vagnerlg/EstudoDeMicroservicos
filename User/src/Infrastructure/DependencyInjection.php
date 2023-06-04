<?php

namespace Infrastructure;

use Application\Contracts\Factory\AddressFactoryInterface;
use Application\Contracts\Factory\UserFactoryInterface;
use Application\Contracts\RepositoryInterface;
use Application\Factory\AddressFactory;
use Application\Factory\UserFactory;
use DI\Container;
use Infrastructure\Api\Controller\AddressController;
use Infrastructure\Api\Controller\UserController;
use Infrastructure\Mongo\Client;
use Infrastructure\Mongo\Repository;
use Psr\Container\ContainerInterface;

readonly class DependencyInjection
{
    public function __construct(private ContainerInterface $container = new Container())
    {
    }

    public function make(): ContainerInterface
    {
        $this->container->set(UserController::class,
            function (ContainerInterface $container): UserController {
                return new UserController($container->get(RepositoryInterface::class), $container->get(UserFactoryInterface::class));
            });

        $this->container->set(AddressController::class,
            function (ContainerInterface $container): AddressController {
                return new AddressController($container->get(RepositoryInterface::class), $container->get(AddressFactoryInterface::class));
            });

        $this->container->set(Client::class,
            function (ContainerInterface $container): Client {
                return new Client(new \MongoDB\Client('mongodb://root:example@mongo:27017/'));
            });

        $this->container->set(UserFactoryInterface::class, function (ContainerInterface $container): UserFactory {
            return new UserFactory($this->container->get(AddressFactoryInterface::class));
        });

        $this->container->set(AddressFactoryInterface::class, function (ContainerInterface $container): AddressFactory {
            return new AddressFactory();
        });

        $this->container->set(RepositoryInterface::class,
            function (ContainerInterface $container): Repository {
                return new Repository(
                    $this->container->get(Client::class),
                    $this->container->get(UserFactoryInterface::class),
                );
            });

        return $this->container;
    }
}