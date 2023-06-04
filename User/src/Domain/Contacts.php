<?php

namespace Domain;

use Domain\Exceptions\ErrorBag;
use Domain\Exceptions\InvalidArgumentException;
use Respect\Validation\Validator;

readonly class Contacts
{
    /**
     * @throws InvalidArgumentException
     */
    public function __construct(
        public ?string $email = null,
        public ?string $phone = null,
    )
    {
        if (!$this->email && !$this->phone) {
            $errors[] = new ErrorBag('contacts', 'invalid', 'Email or Phone is required.');
        }

        if ($this->email && !Validator::email()->validate($this->email)) {
            $errors[] = new ErrorBag('email', 'invalid', 'Email is invalid.');
        }

        if ($this->phone && !Validator::phone()->validate($this->phone)) {
            $errors[] = new ErrorBag('phone', 'invalid', 'Phone is invalid.');
        }

        if ($errors ?? null) {
            throw new InvalidArgumentException(
                ...$errors
            );
        }
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'phone' => $this->phone,
        ];
    }
}