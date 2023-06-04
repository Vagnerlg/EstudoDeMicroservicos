<?php

namespace Domain;

use Domain\Validator\TraitValidator;
use Domain\Validator\Validator;

class Email
{
    use TraitValidator;

    public function __construct(
        #[Validator('email')]
        private readonly string $email
    )
    {
        $this->check();
    }
}