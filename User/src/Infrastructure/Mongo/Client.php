<?php

namespace Infrastructure\Mongo;

use MongoDB\Client as ClientMongo;
use MongoDB\Database;

readonly class Client
{
    public Database $database;
    public function __construct(private ClientMongo $client)
    {
        $this->database = $this->client->selectDatabase('mongodotnet');
    }
}