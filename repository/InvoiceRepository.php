<?php

require_once '../config/Database.php';
require_once '../domain/Invoice.php';

class InvoiceRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Invoice $invoice): void
    {
        $statement = $this->connection->prepare("INSERT INTO invoice (name, price, signature) VALUES (?, ?, ?);");
        $statement->execute([$invoice->name, $invoice->price, $invoice->signature]);
    }

    public function findById($id): ?Invoice
    {
        $statement = $this->connection->prepare("SELECT * FROM invoice WHERE id = ?;");
        $statement->execute([$id]);
        try {
            if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $invoice = new Invoice();
                $invoice->id = ($id);
                $invoice->name = ($row['name']);
                $invoice->price = ($row['price']);
                $invoice->signature = ($row['signature']);

                return $invoice;

            } else {
                return null;
            }

        } finally {
            $statement->closeCursor();
        }
    }


}