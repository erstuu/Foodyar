<?php

class DashboardService
{
    private DashboardRepository $dashboardRepository;

    public function __construct(DashboardRepository $loggingRepository)
    {
        $this->dashboardRepository = $loggingRepository;
    }

    public function save(DashboardInsertRequest $request)
    {
        $target_dir = __DIR__ . '/../uploads/';

        $extension = pathinfo($request->image['name'], PATHINFO_EXTENSION);
        $newImageName = uniqid() . '.' . $extension;

        $target_file = $target_dir . $newImageName;
        move_uploaded_file($request->image['tmp_name'], $target_file);

        $dashboard = new Dashboard();
        $dashboard->name = $request->name;
        $dashboard->price = $request->price;
        $dashboard->image = $newImageName;

        $this->dashboardRepository->save($dashboard);
    }

    public function findById(int $id)
    {
        return $this->dashboardRepository->findById($id);
    }

    public function showAll()
    {
        return $this->dashboardRepository->showAll();

    }

    public function delete(int $id)
    {
        $this->dashboardRepository->delete($id);
    }

    public function update(DashboardInsertRequest $request, int $id)
    {
        $target_dir = __DIR__ . '/../uploads/';

        $extension = pathinfo($request->image['name'], PATHINFO_EXTENSION);
        $newImageName = uniqid() . '.' . $extension;

        $target_file = $target_dir . $newImageName;
        move_uploaded_file($request->image['tmp_name'], $target_file);

        $dashboard = new Dashboard();
        $dashboard->id = $id;
        $dashboard->name = $request->name;
        $dashboard->price = $request->price;
        $dashboard->image = $newImageName;

        $this->dashboardRepository->update($dashboard);
    }
}