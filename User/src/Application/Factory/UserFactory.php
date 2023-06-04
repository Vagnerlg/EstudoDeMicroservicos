<?php

namespace Application\Factory;

use Application\Contracts\Factory\UserFactoryInterface;
use Domain\Addresses;
use Domain\Contacts;
use Domain\Exceptions\InvalidArgumentException;
use Domain\User;
use TypeError;

class UserFactory implements UserFactoryInterface
{
    public function __construct(private readonly AddressFactory $addressFactory)
    {
    }

    /**
     * @throws InvalidArgumentException
     * @throws TypeError
     */
    public function make(array $input): User
    {
        return new User(
            $input['name'] ?? null,
            new Contacts(
                $input['contacts']['email'] ?? null,
                $input['contacts']['phone'] ?? null
            ),
            $this->addresses($input['addresses'] ?? []),
            $this->getId($input)
        );
    }

    private function getId(array $input): ?string
    {
        if (!isset($input['id']) && !isset($input['_id'])) {
            return null;
        }


        return $input['id'] ?? (string) $input['_id'];
    }

    private function addresses($addresses): Addresses
    {
        $data = new Addresses();
        foreach ($addresses as $address) {
            $data->add($this->addressFactory->make($address));
        }

        return $data;
    }
}