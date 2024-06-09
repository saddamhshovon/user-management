<?php

namespace App\Core;

use PDO;
use PDOStatement;

class Database
{
    public PDO $connection;

    public PDOStatement $statement;

    public function __construct($config, $username = 'root', $password = '')
    {
        $dsn = 'mysql:'.http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    }

    public function query($query, $params = []): static
    {
        $this->statement = $this->connection->prepare($query);

        $this->statement->execute($params);

        return $this;
    }

    public function get(): array
    {
        return $this->statement->fetchAll();
    }

    public function find(): array|bool
    {
        return $this->statement->fetch();
    }

    public function findOrFail(): array
    {
        $result = $this->find();

        if (! $result) {
            abort();
        }

        return $result;
    }
}
