<?php

namespace Application\Contracts\Factory;

use Domain\Address;

interface AddressFactoryInterface
{
    public function make(array $input): Address;
}