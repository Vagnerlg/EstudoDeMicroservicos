<?php

namespace Domain\Validator;

use Attribute;

#[Attribute]
class Validator
{
    private readonly array $rules;

    public function __construct(string ...$rules)
    {
        $this->rules = $rules;
    }
}