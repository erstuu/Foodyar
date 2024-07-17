<?php

require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../repository/DashboardRepository.php";
require_once __DIR__ . "/../service/DashboardService.php";
require_once __DIR__ . "/../domain/Dashboard.php";
require_once __DIR__ . "/../model/DashboardInsertRequest.php";

class DashboardController
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

    public function showAll(): array
    {
        return $this->dashboardService->showAll();
    }

    public function postCreate(DashboardInsertRequest $request) {
        try {
            $this->dashboardService->save($request);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

    public function delete(int $id)
    {
        try {
            $this->dashboardService->delete($id);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update(DashboardInsertRequest $request, int $id)
    {
        try {
            $this->dashboardService->update($request, $id);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}