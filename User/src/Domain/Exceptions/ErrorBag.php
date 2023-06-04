<?php

namespace Domain\Exceptions;

readonly class ErrorBag
{
    public function __construct(
        public string $field,
        public string $code,
        public string $message,
    )
    {
    }
}