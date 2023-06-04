<?php

namespace Domain;

class Addresses
{
    private array $container = [];

    public function has(string $id): bool
    {
        foreach ($this->container as $address) {
            if (!$address->id == $id) {
                continue;
            }

            return true;
        }

        return false;
    }

    public function get(string $id): ?Address
    {
        foreach ($this->container as $address) {
            if (!$address->id == $id) {
                continue;
            }

            return $address;
        }

        return null;
    }

    public function add(Address $address): void
    {
        $this->container[] = $address;
    }

    public function remove(string $id): void
    {
        foreach ($this->container as $key => $address) {
            if (!$address->id == $id) {
                continue;
            }

            unset($this->container[$key]);
            return;
        }
    }

    public function toArray(): array
    {
        foreach ($this->container as $address) {
            $data[] = $address->toArray();
        }

        return $data ?? [];
    }
}