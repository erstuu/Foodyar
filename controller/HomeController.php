<?php

require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../repository/DashboardRepository.php";
require_once __DIR__ . "/../service/DashboardService.php";
require_once __DIR__ . "/../domain/Dashboard.php";
require_once __DIR__ . "/../model/DashboardInsertRequest.php";

class HomeController
{
    private DashboardService $dashboardService;

    public function __construct()
    {
        $database = new Database();
        $connection = $database->getConnection();
        $loggingRepository = new DashboardRepository($connection);
        $this->dashboardService = new DashboardService($loggingRepository);
    }

    public function findById(int $id)
    {
        return $this->dashboardService->findById($id);
    }

    public function showAllProduct(): array
    {
        return $this->dashboardService->showAll();
    }
}