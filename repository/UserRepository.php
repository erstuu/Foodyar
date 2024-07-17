<?php

require_once '../config/Database.php';
require_once '../domain/User.php';

class UserRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findByName(string $name): ?User
    {
        $statement = $this->connection->prepare("SELECT * FROM users WHERE username = ?;");
        $statement->execute([$name]);
        try {
            if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $user = new User();
                $user->name = ($row['username']);
                $user->password = ($row['password']);

                return $user;

            } else {
                return null;
            }

        } finally {
            $statement->closeCursor();
        }
    }

    public function save(User $user): User
    {
        $statement = $this->connection->prepare("INSERT INTO users(username, password) VALUES (?, ?);");
        $statement->execute([$user->name, $user->password]);

        return $user;
    }


}