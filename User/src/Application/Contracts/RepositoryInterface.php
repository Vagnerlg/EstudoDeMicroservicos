<?php

namespace Application\Contracts;

use Domain\User;

interface RepositoryInterface
{
    public function first(string $id): ?User;

    /**
     * @return User[]
     */
    public function all(): array;

    public function create(User $user): ?string;
    public function update(User $user): bool;
}