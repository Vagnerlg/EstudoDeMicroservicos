<?php

namespace Infrastructure\Api\Controller;

use Application\Contracts\Factory\UserFactoryInterface;
use Application\Contracts\RepositoryInterface;
use Domain\Exceptions\ErrorBag;
use Domain\Exceptions\InvalidArgumentException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use TypeError;

class UserController
{
    use TraitController;

    public function __construct(
        private readonly RepositoryInterface $userRepository,
        private readonly UserFactoryInterface $factory
    )
    {
    }

    public function all(RequestInterface $request, ResponseInterface $response): ResponseInterface {
        foreach ($this->userRepository->all() as $user) {
            $users[] = $user->toArray();
        }

        return $this->responseOk($response, $users ?? []);
    }

    public function find(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        if ($user = $this->userRepository->first($args['id'])) {
            return $this->responseNotFound($response, 'user');
        }

        return $this->responseOk($response, $user->toArray());
    }

    public function create(RequestInterface $request, ResponseInterface $response): ResponseInterface {
        try {
            $user = $this->factory->make($this->getData($request));
            if (!$id = $this->userRepository->create($user)) {
                return $this->responseErrors($response, new ErrorBag('user', 'invalid', 'error server.'));
            }
        } catch (InvalidArgumentException $e) {
            return $this->responseErrors($response, ...$e->errors);
        } catch (TypeError $e) {
            return $this->responseErrors($response, new ErrorBag('name', 'required', 'name is required.'));
        }

        return $this->responseOk($response, array_merge($user->toArray(), ['id' => $id]));
    }
}