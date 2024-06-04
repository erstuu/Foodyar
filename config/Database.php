<?php
class Database
{
    private $host = 'localhost';
    private $db_name = 'foodyar';
    private $username = 'root';
    private $password = 'root';
    private ?\PDO $connection = null;

    public function __construct()
    {
    }

    public function getConnection(): \PDO
    {
        if($this->connection === null) {
            try {
                $this->connection = new \PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
                $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            } catch (\PDOException $exception) {
                echo "Connection error: " . $exception->getMessage();
                throw $exception;
            }
        }
        return $this->connection;
    }
}