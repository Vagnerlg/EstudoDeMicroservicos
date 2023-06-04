<?php

namespace Infrastructure\Mongo;

use Application\Contracts\Factory\UserFactoryInterface;
use Application\Contracts\RepositoryInterface;
use Domain\User;
use MongoDB\BSON\ObjectId;
use MongoDB\Collection;
use MongoDB\Driver\Exception\InvalidArgumentException;

readonly class Repository implements RepositoryInterface
{
    private Collection $collection;

    public function __construct(private Client $client, private UserFactoryInterface $factory)
    {
        $this->collection = $this->client->database->selectCollection('users');
    }

    public function first(string $id): ?User
    {
        try {
            $user = $this->collection->findOne([
                '_id' => new ObjectId($id)
            ]);
        } catch (InvalidArgumentException $e) {
            return null;
        }

        return $this->factory->make((array) $user);
    }

    public function all(): array
    {
        foreach ($this->collection->find() as $user) {
            $users[] = @$this->factory->make((array)$user);
        }

        return $users ?? [];
    }

    public function create(User $user): ?string
    {
        $result = $this->collection->insertOne($user->toArray());

        return (string) $result->getInsertedId();
    }

    public function update(User $user): bool
    {
        $data = $user->toArray();
        unset($data['id']);

        $result = $this->collection->updateOne([
            '_id' => new ObjectId($user->id),
        ], [
            '$set' => $data
        ]);

        return (string) $result->isAcknowledged();
    }
}