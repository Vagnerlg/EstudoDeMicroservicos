<?php

namespace Domain;

readonly class Address
{
    public function __construct(
        public string  $postalCode,
        public string  $street,
        public string  $district,
        public string  $city,
        public string  $state,
        public string  $number,
        public ?string $complement = null,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'postalCode' => $this->postalCode,
            'street' => $this->street,
            'district' => $this->district,
            'city' => $this->city,
            'state' => $this->state,
            'number' => $this->number,
            'complement' => $this->complement,
        ];
    }
}