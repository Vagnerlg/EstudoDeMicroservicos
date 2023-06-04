<?php

namespace Application\Contracts\Factory;

use Domain\User;

interface UserFactoryInterface
{
    public function make(array $input): User;
}