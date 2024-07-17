<?php

class Database
{
    private $host = 'localhost';
    private $db_name = 'db_foodyar';
    private $username = 'root';
    private $password = '';
    private ?PDO $connection = null;

    public function getConnection(): PDO
    {
        if ($this->connection === null) {
            try {
                $this->connection = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
            } catch (PDOException $exception) {
                echo "Connection error: " . $exception->getMessage();
                throw $exception;
            }
        }
        return $this->connection;
    }
}
/**
 *
 */
/**
 * private $host = 'localhost';
 * private $db_name = 'u341021167_kelasb';
 * private $username = 'u341021167_kelasb';
 * private $password = 'Kelasb_123';
 *
 * 2230511063_users
 * 2230511063_dashboard
 *
 * private $host = 'localhost';
 * private $db_name = 'db_foodyar';
 * private $username = 'root';
 * private $password = '';
 * private ?\PDO $connection = null;
 *
 * users
 * dashboard
 */