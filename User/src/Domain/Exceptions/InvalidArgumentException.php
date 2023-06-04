<?php

namespace Domain\Exceptions;

use Exception;

class InvalidArgumentException extends Exception
{
    public readonly array $errors;

    public function __construct(ErrorBag ...$errors)
    {
        $this->errors = $errors;

        parent::__construct();
    }
}