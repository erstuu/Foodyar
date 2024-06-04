<?php

require_once '../config/Database.php';
require_once '../domain/Logging.php';

class LoggingRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Logging $logging): Logging {
        $statement = $this->connection->prepare("INSERT INTO logging (name, price, image) VALUES (?, ?, ?);");
        $statement->execute([$logging->name, $logging->price, $logging->image]);

        return $logging;
    }

    public function findById($id): ?Logging {
        $statement = $this->connection->prepare("SELECT * FROM logging WHERE id = ?;");
        $statement->execute([$id]);
        try {
            if($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $logging = new Logging();
                $logging->name = ($row['name']);
                $logging->price = ($row['price']);
                $logging->image = ($row['image']);

                return $logging;

            } else {
                return null;
            }

        }finally {
            $statement->closeCursor();
        }
    }
    public function showAll() {
        $statement = $this->connection->prepare("SELECT * FROM logging;");
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        $logging = [];
        foreach($rows as $row) {
            $loggingItem = new Logging();
            $loggingItem->name = $row['name'];
            $loggingItem->price = $row['price'];
            $loggingItem->image = $row['image'];
            $logging[] = $loggingItem;
        }
        return $logging;
    }
}