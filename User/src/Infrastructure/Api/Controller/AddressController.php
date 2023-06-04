<?php

namespace Infrastructure\Api\Controller;

use Application\Contracts\Factory\AddressFactoryInterface;
use Application\Contracts\RepositoryInterface;
use Domain\Exceptions\ErrorBag;
use Domain\Exceptions\InvalidArgumentException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use TypeError;

class AddressController
{
    use TraitController;

    public function __construct(
        private readonly RepositoryInterface $userRepository,
        private readonly AddressFactoryInterface $factory,
    ){}

    public function create(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        if (!$user = $this->userRepository->first($args['userId'])) {
            return $this->responseErrors($response, new ErrorBag('user', 'notFound', 'User not found.'));
        }

        try{
            $address = $this->factory->make($this->getData($request));
            $user->addresses->add($address);
            if (!$this->userRepository->update($user)) {
                return $this->responseErrors($response, new ErrorBag('address', 'invalid', 'error server.'));
            }
        } catch (InvalidArgumentException $e) {
            return $this->responseErrors($response, ...$e->errors);
        } catch (TypeError $e) {
            return $this->responseErrors($response,
                new ErrorBag('address', 'required', 'postalCode, street, district, city, state, number is required.'));
        }

        return $this->responseOk($response, $address);
    }
}