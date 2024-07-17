<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../domain/Dashboard.php';

class DashboardRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Dashboard $dashboard): void
    {
        $statement = $this->connection->prepare("INSERT INTO dashboard (name, price, image) VALUES (?, ?, ?);");
        $statement->execute([$dashboard->name, $dashboard->price, $dashboard->image]);
    }

    public function findById($id): ?Dashboard
    {
        $statement = $this->connection->prepare("SELECT * FROM dashboard WHERE id = ?;");
        $statement->execute([$id]);
        try {
            if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $dashboard = new Dashboard();
                $dashboard->id = ($id);
                $dashboard->name = ($row['name']);
                $dashboard->price = ($row['price']);
                $dashboard->image = ($row['image']);

                return $dashboard;

            } else {
                return null;
            }

        } finally {
            $statement->closeCursor();
        }
    }

    public function showAll(): array
    {
        $statement = $this->connection->prepare("SELECT * FROM dashboard ORDER BY name ASC;");
        $statement->execute();
        $rows = $statement->fetchAll();

        $dashboard = [];
        foreach ($rows as $row) {
            $dashboardItem = new Dashboard();
            $dashboardItem->id = $row['id'];
            $dashboardItem->name = $row['name'];
            $dashboardItem->price = $row['price'];
            $dashboardItem->image = $row['image'];

            $dashboard[] = $dashboardItem;
        }
        return $dashboard;
    }

    public function delete(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM dashboard WHERE id = ?;");
        $statement->execute([$id]);
    }

    public function update(Dashboard $dashboard): void
    {
        $statement = $this->connection->prepare("UPDATE dashboard SET name = ?, price = ?, image = ? WHERE id = ?;");
        $statement->execute([$dashboard->name, $dashboard->price, $dashboard->image, $dashboard->id]);
    }

//    public function generateInvoice(DashboardGenerateInvoice $request): void
//    {
//        $statement = $this->connection->prepare("INSERT INTO invoice (name, price, signature) VALUES (?, ?, ?)");
//        $statement->execute([$request->name, $request->price, $request->signature]);
//    }
}