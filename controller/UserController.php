<?php
require_once '../config/Database.php';

class UserController
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }



}
