<?php

namespace Application\Factory;

use Application\Contracts\Factory\AddressFactoryInterface;
use Domain\Address;

class AddressFactory implements AddressFactoryInterface
{

    public function make($input): Address
    {
        return new Address(
            $input['postalCode'] ?? null,
                $input['street'] ?? null,
                $input['district'] ?? null,
                $input['city'] ?? null,
                $input['state'] ?? null,
                $input['number'] ?? null,
                $input['complement'] ?? null,
        );
    }
}