<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../domain/Csv.php';

class csvRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Csv $csv): void
    {
        $statement = $this->connection->prepare("INSERT INTO csv (
                 id, 
                 customer, 
                 first_name, 
                 last_name, 
                 company,
                 city,
                 country,
                 phone_1,
                 phone_2,
                 email,
                 subscription_date,
                 website
                 ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
        $statement->execute([
            $csv->id,
            $csv->customer_id,
            $csv->first_name,
            $csv->last_name,
            $csv->company,
            $csv->city,
            $csv->country,
            $csv->phone_1,
            $csv->phone_2,
            $csv->email,
            $csv->subscription_date,
            $csv->website
        ]);
    }

    public function findAll(): array
    {
        $statement = $this->connection->prepare("SELECT * FROM csv");
        $statement->execute();
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
}