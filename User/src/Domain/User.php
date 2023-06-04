<?php

namespace Domain;

class User
{
    public function __construct(
        public readonly string $name,
        public readonly Contacts $contacts,
        public readonly Addresses $addresses = new Addresses(),
        public readonly ?string $id = null
    )
    {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'contacts' => $this->contacts->toArray(),
            'addresses' => $this->addresses->toArray(),
        ];
    }
}